<?php


namespace VanguardLTE\Games\GreentubeLib\MoneyTransfer;


use VanguardLTE\Services\Api\Api;
use Illuminate\Support\Facades\Log;
use VanguardLTE\Games\GreentubeLib\Statistic\Statistic;

class SwitchBoard
{
    public static function SwitchMoney($slotArea, $shop, $bank, $jpgs, $gameSettings, $totalWin, $user, $game, $gameData, $needReserve, $freespins = false){
        $bet = ($gameData['BetToLine'] * $gameSettings->multipliers[$gameData['Multiplier']]) / $game->denomination;
        $totalWin = $totalWin / $game->denomination;
        $endFS = false;

        // если выигрыша нет - то просто отнять ставку у пользователя и записать в статистику результат спина,
        //а так же добавить деньги в банк и джекпот и в rtp поля слота total_in
        //Если игрок играет на выигранные деньги а свои закончились - то вся сумма ставки идет в банк слота.
        if ($freespins) $bet = 0;
        $user->balance -= $bet;
        if ($user->count_balance > 0 && $user->count_balance > $bet ) { // если не закончились свои деньги
        $user->count_balance -= $bet;
        $myMoney = $bet;
        }
        elseif ($user->count_balance < $bet && $user->count_balance > 0) { // если своих денег недостаточно для ставки
            $myMoney = $user->count_balance;
            $user->count_balance = 0;
        }else $myMoney = 0;
        $user->save();

        $toJackpot = Jackpots::toJP($myMoney, $jpgs);
        $toProfit = $myMoney * ((100 - $shop->percent) / 100);
        $toSlotBank = SlotBank::addBank($bet, $shop, $bank, $toJackpot, $toProfit); // в банк идет bet потому что в маймоней может быть 0

        $game->stat_in += $toSlotBank;
        $game->save();

        if (!$freespins) { // если не фриспины то расчет из банка, иначе из резерва
            // Если выигрыш - то отнять от банка выигрыш и изменить в игре количество выплаченого
            $bank->slots -= $totalWin;
        }else{
            $bank->bonus -= $totalWin;
        }

        // запись в статистику
        Statistic::setStatistic($user, $totalWin, $game, $bank, $bet, $toSlotBank, $toJackpot, $toProfit, $freespins, $slotArea);

        $bank->save();
    }

    public static function collectMoney($log,$user,$game){
        //записать в баланс пользователю
        $user->balance += $log['TotalWin'] / $game->denomination;
        //записать в выплаты слоту
        $game->stat_out += $log['TotalWin'] / $game->denomination;
        $user->save();
        $game->save();
        $log['Balance'] = $user->balance * $game->denomination;
        return $log;
    }

    public static function gambleCalculateMoney($user,$game,$bank, $bet, $totalWin){
        $bet = $bet / $game->denomination;
        $totalWin =$totalWin / $game->denomination;
        // вернуть в банк если проигрыш
        if ($totalWin == 0) $bank->slots += $bet;
        // забрать из банка если выигрыш
        else $bank->slots -= $totalWin / 2;
        // записать в статистику
        Statistic::setGamble($user,$game,$bet,$totalWin,$bank);
        // сохранить банк
        $bank->save();
    }
}
