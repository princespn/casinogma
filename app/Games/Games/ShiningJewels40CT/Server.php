<?php 
namespace VanguardLTE\Games\ShiningJewels40CT
{
    set_time_limit(5);
    class Server
    {
        public function get($request, $game)
        {
            function get_($request, $game)
            {
                \DB::transaction(function() use ($request, $game)
                {
                    try
                    {
                        $userId = \Auth::id();
                        if( $userId == null ) 
                        {
                            $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid login"}';
                            exit( $response );
                        }
                        $slotSettings = new SlotSettings($game, $userId);
                        if( !$slotSettings->is_active() ) 
                        {
                            $response = '{"responseEvent":"error","responseType":"","serverResponse":"Game is disabled"}';
                            exit( $response );
                        }
                        if( !isset($_POST['request']) ) 
                        {
                            $response = '{"responseEvent":"error","responseType":"","serverResponse":"Invalid request state"}';
                            exit( $response );
                        }
                        $postData = json_decode(trim($_POST['request']), true);
                        $postData = $postData[0];
                        $balanceInCents = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                        $result_tmp = [];
                        $aid = '';
                        if( isset($postData['type']) && $postData['command'] == 'continue' && $postData['type'] == 'can_play_red_black_double' && isset($postData['continue_params']['double_key']) ) 
                        {
                            $postData['command'] = 'gamble';
                        }
                        if( $postData['command'] == 'gamble' && $slotSettings->GetGameData($slotSettings->slotId . 'TotalWin') <= 0 ) 
                        {
                            $response = '{"responseEvent":"error","responseType":"' . $postData['command'] . '","serverResponse":"invalid gamble state"}';
                            exit( $response );
                        }
                        $responseData = json_decode(trim(file_get_contents(dirname(__FILE__) . '/response_template.json')), true);
                        $responseDataOrig = $responseData;
                        $aid = (string)$postData['command'];
                        switch( $aid ) 
                        {
                            case 'create_session':
                                $slotSettings->SetGameData('ShiningJewels40CTCards', [
                                    19, 
                                    44, 
                                    0, 
                                    37, 
                                    8, 
                                    28, 
                                    33
                                ]);
                                for( $i = 0; $i < count($slotSettings->Denominations); $i++ ) 
                                {
                                    $responseData['create_session'][0]['enabled_denoms'][] = (object)[
                                        'label' => '' . sprintf('%01.2f', $slotSettings->Denominations[$i]), 
                                        'id' => '' . sprintf('%01.2f', $slotSettings->Denominations[$i]), 
                                        'viewLabel' => '' . $slotSettings->CurrentDenom, 
                                        'value' => $slotSettings->Denominations[$i], 
                                        'cents' => $slotSettings->Denominations[$i] * 100
                                    ];
                                }
                                $responseData['create_session'][0]['account_status']['currency'] = $slotSettings->slotCurrency;
                                $responseData['create_session'][0]['account_status']['currency_code'] = $slotSettings->slotCurrency;
                                $result_tmp[] = json_encode($responseData['create_session']);
                                break;
                            case 'continue':
                                $gameBets = $slotSettings->Bet;
                                $responseData['continue'][0]['account_status']['credit'] = round($balanceInCents);
                                $result_tmp[] = json_encode($responseData['continue']);
                                break;
                            case 'init_game':
                                $gameBets = $slotSettings->Bet;
                                $lastEvent = $slotSettings->GetHistory();
                                $slotSettings->SetGameData('ShiningJewels40CTBonusWin', 0);
                                $slotSettings->SetGameData('ShiningJewels40CTFreeGames', 0);
                                $slotSettings->SetGameData('ShiningJewels40CTCurrentFreeGame', 0);
                                $slotSettings->SetGameData('ShiningJewels40CTCurrentFreeGame0', 0);
                                $slotSettings->SetGameData('ShiningJewels40CTTotalWin', 0);
                                $slotSettings->SetGameData('ShiningJewels40CTFreeBalance', 0);
                                $responseData['init_game'][0]['game_config']['game_denoms'] = [];
                                for( $i = 0; $i < count($slotSettings->Denominations); $i++ ) 
                                {
                                    $responseData['init_game'][0]['game_config']['game_denoms'][sprintf('%01.2f', $slotSettings->Denominations[$i])] = '' . sprintf('%01.2f', $slotSettings->Denominations[$i]);
                                }
                                $responseData['init_game'][0]['game_config']['game_denoms'] = (object)$responseData['init_game'][0]['game_config']['game_denoms'];
                                $responseData['init_game'][0]['account_status']['credit'] = round($balanceInCents);
                                if( $lastEvent != 'NULL' ) 
                                {
                                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', $lastEvent->serverResponse->bonusWin);
                                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', $lastEvent->serverResponse->totalFreeGames);
                                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', $lastEvent->serverResponse->currentFreeGames);
                                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame0', $lastEvent->serverResponse->currentFreeGames);
                                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', $lastEvent->serverResponse->bonusWin);
                                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', $lastEvent->serverResponse->Balance);
                                    $slotSettings->SetGameData($slotSettings->slotId . 'Results', $lastEvent->serverResponse->result);
                                    $slotSettings->SetGameData($slotSettings->slotId . 'Reels', $lastEvent->serverResponse->reelsSymbols);
                                    $slotSettings->SetGameData($slotSettings->slotId . 'Lines', $lastEvent->serverResponse->slotLines);
                                    $slotSettings->SetGameData($slotSettings->slotId . 'Bet', $lastEvent->serverResponse->slotBet);
                                    $slotSettings->SetGameData($slotSettings->slotId . 'Denom', $lastEvent->serverResponse->slotDenom);
                                    $reels = $lastEvent->serverResponse->reelsSymbols;
                                    $responseData['init_game'][0]['game_config']['init_screen'][0] = [
                                        '' . $reels->reel1[0], 
                                        '' . $reels->reel2[0], 
                                        '' . $reels->reel3[0], 
                                        '' . $reels->reel4[0], 
                                        '' . $reels->reel5[0]
                                    ];
                                    $responseData['init_game'][0]['game_config']['init_screen'][1] = [
                                        '' . $reels->reel1[1], 
                                        '' . $reels->reel2[1], 
                                        '' . $reels->reel3[1], 
                                        '' . $reels->reel4[1], 
                                        '' . $reels->reel5[1]
                                    ];
                                    $responseData['init_game'][0]['game_config']['init_screen'][2] = [
                                        '' . $reels->reel1[2], 
                                        '' . $reels->reel2[2], 
                                        '' . $reels->reel3[2], 
                                        '' . $reels->reel4[2], 
                                        '' . $reels->reel5[2]
                                    ];
                                    $responseData['init_game'][0]['game_config']['init_screen'][3] = [
                                        '' . $reels->reel1[3], 
                                        '' . $reels->reel2[3], 
                                        '' . $reels->reel3[3], 
                                        '' . $reels->reel4[3], 
                                        '' . $reels->reel5[3]
                                    ];
                                    $lines = $lastEvent->serverResponse->slotLines;
                                    $bet = $lastEvent->serverResponse->slotBet;
                                    $denom = $lastEvent->serverResponse->slotDenom;
                                    if( $slotSettings->GetGameData('ShiningJewels40CTCurrentFreeGame') < $slotSettings->GetGameData('ShiningJewels40CTFreeGames') && $slotSettings->GetGameData('ShiningJewels40CTFreeGames') > 0 ) 
                                    {
                                        $responseData['init_game'][0]['game_config']['init_screen_subgame_label'] = 'free';
                                        $responseData['init_game'][0]['game_config']['main_subgame_label'] = 'free';
                                        $responseData['init_game'][0]['freeround_limit'] = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames');
                                        $responseData['init_game'][0]['freeround_play'] = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame0');
                                        $responseData['init_game'][0]['freeround_bet_per_line_cents'] = $bet * $denom * 100;
                                        $responseData['init_game'][0]['freeround_lines'] = $lines;
                                        $denomIndex = 0;
                                        for( $d = 0; $d < count($slotSettings->Denominations); $d++ ) 
                                        {
                                            if( $slotSettings->Denominations[$d] == $slotSettings->GetGameData($slotSettings->slotId . 'Denom') ) 
                                            {
                                                $denomIndex = $d;
                                            }
                                        }
                                        $responseData['init_game'][0]['account_status']['credit'] = $slotSettings->GetGameData($slotSettings->slotId . 'FreeBalance');
                                        $responseData['init_game'][0]['resume_game'] = (object)[
                                            'extra_bet' => 0, 
                                            'line_bet' => $bet / $denom, 
                                            'lines' => $lines, 
                                            'denomIndex' => 0, 
                                            'currDenom' => [
                                                'cents' => $denom * 100, 
                                                'value' => sprintf('%01.2f', $denom), 
                                                'label' => '' . sprintf('%01.2f', $denom), 
                                                'id' => '' . sprintf('%01.2f', $denom)
                                            ], 
                                            'last_result' => $lastEvent->serverResponse->result, 
                                            'account_status_after_bet' => $responseData['init_game'][0]['account_status'], 
                                            'game_config' => $responseData['init_game'][0]['game_config'], 
                                            'server_denom' => [
                                                'cents' => $denom * 100, 
                                                'value' => sprintf('%01.2f', $denom), 
                                                'label' => '' . sprintf('%01.2f', $denom), 
                                                'id' => '' . sprintf('%01.2f', $denom)
                                            ], 
                                            'game_denom' => '' . sprintf('%01.2f', $denom), 
                                            'enabled_denoms' => [
                                                'cents' => $denom * 100, 
                                                'value' => sprintf('%01.2f', $denom), 
                                                'label' => '' . sprintf('%01.2f', $denom), 
                                                'id' => '' . sprintf('%01.2f', $denom)
                                            ], 
                                            'resume_subgame_index' => $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame0') + 1
                                        ];
                                        $responseData['init_game'][0]['resume'] = true;
                                    }
                                }
                                else
                                {
                                    $lines = 30;
                                    $bet = $slotSettings->Bet[0];
                                    $denom = $slotSettings->Denominations[0];
                                }
                                $responseData['init_game'][0]['game_config']['line_step_bet_numbers'] = $gameBets;
                                $responseData['init_game'][0]['game_config']['line_step_bet_numbers_quick'] = $gameBets;
                                $responseData['init_game'][0]['game_config']['line_max_bet'] = $gameBets[count($gameBets) - 1];
                                $responseData['init_game'][0]['game_config']['line_min_bet'] = $gameBets[0];
                                $result_tmp[] = json_encode($responseData['init_game']);
                                break;
                            case 'poll':
                                $gameBets = $slotSettings->Bet;
                                if( $slotSettings->GetGameData('ShiningJewels40CTCurrentFreeGame') < $slotSettings->GetGameData('ShiningJewels40CTFreeGames') && $slotSettings->GetGameData('ShiningJewels40CTFreeGames') > 0 ) 
                                {
                                    $balanceInCents = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                                }
                                else
                                {
                                    $balanceInCents = sprintf('%01.2f', $slotSettings->GetBalance() - $slotSettings->GetGameData('ShiningJewels40CTTotalWin')) * 100;
                                }
                                $responseData['poll'][0]['account_status']['credit'] = (string)round($balanceInCents);
                                $responseData['poll'][0]['account_status']['updated_credit'] = (string)round($balanceInCents);
                                $result_tmp[] = json_encode($responseData['poll']);
                                break;
                            case 'game_finished':
                                $slotSettings->SetGameData('ShiningJewels40CTBonusWin', 0);
                                $slotSettings->SetGameData('ShiningJewels40CTTotalWin', 0);
                                $responseData['game_finished'][0]['freeround_play'] = $slotSettings->GetGameData('ShiningJewels40CTCurrentFreeGame0');
                                $responseData['game_finished'][0]['account_status']['credit'] = round($balanceInCents);
                                $responseData['game_finished'][0]['account_status']['rgs_balance'] = round($balanceInCents);
                                $result_tmp[] = json_encode($responseData['game_finished']);
                                break;
                            case 'subgame_finished':
                                if( $slotSettings->GetGameData('ShiningJewels40CTCurrentFreeGame0') < $slotSettings->GetGameData('ShiningJewels40CTFreeGames') && $slotSettings->GetGameData('ShiningJewels40CTFreeGames') > 0 ) 
                                {
                                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame0', $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame0') + 1);
                                    $result = $slotSettings->GetGameData($slotSettings->slotId . 'Results');
                                    $lines = $slotSettings->GetGameData($slotSettings->slotId . 'Lines');
                                    $betline = $slotSettings->GetGameData($slotSettings->slotId . 'Bet');
                                    $denom = $slotSettings->GetGameData($slotSettings->slotId . 'Denom');
                                    $cr = (array)$result[$slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame0')];
                                    $totalWin = $cr['total_win'] * $denom;
                                    $reportWin = $cr['win'] * $denom;
                                    $totalWin = sprintf('%01.2f', $totalWin);
                                    $reportWin = sprintf('%01.2f', $reportWin);
                                    $response = '{"responseEvent":"spin","responseType":"freespin","serverResponse":{"result":' . json_encode($result) . ',"slotDenom":' . $slotSettings->GetGameData($slotSettings->slotId . 'Denom') . ',"slotLines":' . $lines . ',"slotBet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData('ShiningJewels40CTFreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData('ShiningJewels40CTCurrentFreeGame0') . ',"Balance":' . $slotSettings->GetGameData('ShiningJewels40CTFreeBalance') . ',"afterBalance":' . $slotSettings->GetGameData('ShiningJewels40CTFreeBalance') . ',"bonusWin":' . $slotSettings->GetGameData('ShiningJewels40CTBonusWin') . ',"totalWin":' . $reportWin . ',"winLines":[],"Jackpots":[],"reelsSymbols":' . json_encode($slotSettings->GetGameData($slotSettings->slotId . 'Reels')) . '}}';
                                    if( $slotSettings->GetGameData('ShiningJewels40CTFreeGames') <= $slotSettings->GetGameData('ShiningJewels40CTCurrentFreeGame0') ) 
                                    {
                                        if( $reportWin > 0 ) 
                                        {
                                            $slotSettings->SetBalance($reportWin);
                                        }
                                        $slotSettings->SaveLogReport($response, 0, $lines, $reportWin, 'freespin');
                                    }
                                    else
                                    {
                                        if( $reportWin > 0 ) 
                                        {
                                            $slotSettings->SetBalance($reportWin);
                                        }
                                        $slotSettings->SaveLogReport($response, 0, $lines, $reportWin, 'freespin');
                                    }
                                    $balanceInCents = $slotSettings->GetGameData('ShiningJewels40CTFreeBalance');
                                    $responseData['subgame_finished'][0]['account_status']['credit'] = round($balanceInCents);
                                    $responseData['subgame_finished'][0]['freeround_play'] = $slotSettings->GetGameData('ShiningJewels40CTCurrentFreeGame0');
                                    $responseData['subgame_finished'][1]['freeround_play'] = $slotSettings->GetGameData('ShiningJewels40CTCurrentFreeGame0');
                                    $responseData['subgame_finished'][0]['account_status']['rgs_balance'] = round($balanceInCents);
                                    $responseData['subgame_finished'][1]['account_status']['credit'] = round($balanceInCents);
                                    $responseData['subgame_finished'][1]['account_status']['rgs_balance'] = round($balanceInCents);
                                }
                                else
                                {
                                    $responseData['subgame_finished'][0]['account_status']['credit'] = round($balanceInCents);
                                    $responseData['subgame_finished'][0]['account_status']['rgs_balance'] = round($balanceInCents);
                                    $responseData['subgame_finished'][1]['account_status']['credit'] = round($balanceInCents);
                                    $responseData['subgame_finished'][1]['account_status']['rgs_balance'] = round($balanceInCents);
                                }
                                $result_tmp[] = json_encode($responseData['subgame_finished']);
                                break;
                            case 'play':
                                if( !isset($postData['lines']) || !isset($postData['line_bet']) || !isset($postData['game_denom']) ) 
                                {
                                    $response = '{"responseEvent":"error","responseType":"' . $postData['command'] . '","serverResponse":"invalid bet state"}';
                                    exit( $response );
                                }
                                $denom = $postData['game_denom'];
                                $lines = $postData['lines'];
                                $betline = sprintf('%01.2f', $postData['line_bet'] * $denom);
                                $allbet = $betline * $lines;
                                $postData['slotEvent'] = 'bet';
                                if( $lines <= 0 || $betline <= 0.0001 || $denom <= 0.0001 || $denom > 1 || $slotSettings->GetBalance() < $allbet ) 
                                {
                                    $response = '{"responseEvent":"error","responseType":"' . $postData['command'] . '","serverResponse":"invalid bet state"}';
                                    exit( $response );
                                }
                                $spinLoopLimit = 1;
                                for( $spinLoop = 0; $spinLoop < $spinLoopLimit; $spinLoop++ ) 
                                {
                                    $linesId = [];
                                    $linesId[0] = [
                                        2, 
                                        2, 
                                        2, 
                                        2, 
                                        2
                                    ];
                                    $linesId[1] = [
                                        3, 
                                        3, 
                                        3, 
                                        3, 
                                        3
                                    ];
                                    $linesId[2] = [
                                        1, 
                                        1, 
                                        1, 
                                        1, 
                                        1
                                    ];
                                    $linesId[3] = [
                                        4, 
                                        4, 
                                        4, 
                                        4, 
                                        4
                                    ];
                                    $linesId[4] = [
                                        2, 
                                        2, 
                                        1, 
                                        2, 
                                        3
                                    ];
                                    $linesId[5] = [
                                        2, 
                                        3, 
                                        4, 
                                        3, 
                                        2
                                    ];
                                    $linesId[6] = [
                                        1, 
                                        1, 
                                        2, 
                                        3, 
                                        4
                                    ];
                                    $linesId[7] = [
                                        4, 
                                        4, 
                                        3, 
                                        2, 
                                        1
                                    ];
                                    $linesId[8] = [
                                        2, 
                                        1, 
                                        1, 
                                        1, 
                                        2
                                    ];
                                    $linesId[9] = [
                                        3, 
                                        4, 
                                        4, 
                                        4, 
                                        3
                                    ];
                                    $linesId[10] = [
                                        1, 
                                        2, 
                                        3, 
                                        4, 
                                        4
                                    ];
                                    $linesId[11] = [
                                        4, 
                                        3, 
                                        2, 
                                        1, 
                                        1
                                    ];
                                    $linesId[12] = [
                                        2, 
                                        1, 
                                        2, 
                                        3, 
                                        2
                                    ];
                                    $linesId[13] = [
                                        3, 
                                        4, 
                                        3, 
                                        2, 
                                        3
                                    ];
                                    $linesId[14] = [
                                        1, 
                                        2, 
                                        1, 
                                        2, 
                                        1
                                    ];
                                    $linesId[15] = [
                                        4, 
                                        3, 
                                        4, 
                                        3, 
                                        4
                                    ];
                                    $linesId[16] = [
                                        2, 
                                        3, 
                                        2, 
                                        1, 
                                        2
                                    ];
                                    $linesId[17] = [
                                        3, 
                                        2, 
                                        3, 
                                        4, 
                                        3
                                    ];
                                    $linesId[18] = [
                                        1, 
                                        2, 
                                        2, 
                                        2, 
                                        1
                                    ];
                                    $linesId[19] = [
                                        4, 
                                        3, 
                                        3, 
                                        3, 
                                        4
                                    ];
                                    $linesId[20] = [
                                        2, 
                                        2, 
                                        3, 
                                        4, 
                                        4
                                    ];
                                    $linesId[21] = [
                                        3, 
                                        3, 
                                        2, 
                                        1, 
                                        1
                                    ];
                                    $linesId[22] = [
                                        2, 
                                        2, 
                                        1, 
                                        2, 
                                        2
                                    ];
                                    $linesId[23] = [
                                        3, 
                                        3, 
                                        4, 
                                        3, 
                                        3
                                    ];
                                    $linesId[24] = [
                                        2, 
                                        3, 
                                        3, 
                                        3, 
                                        4
                                    ];
                                    $linesId[25] = [
                                        3, 
                                        2, 
                                        2, 
                                        2, 
                                        1
                                    ];
                                    $linesId[26] = [
                                        1, 
                                        1, 
                                        2, 
                                        1, 
                                        1
                                    ];
                                    $linesId[27] = [
                                        4, 
                                        4, 
                                        3, 
                                        4, 
                                        4
                                    ];
                                    $linesId[28] = [
                                        1, 
                                        2, 
                                        3, 
                                        3, 
                                        4
                                    ];
                                    $linesId[29] = [
                                        4, 
                                        3, 
                                        2, 
                                        2, 
                                        1
                                    ];
                                    $linesId[30] = [
                                        1, 
                                        1, 
                                        1, 
                                        2, 
                                        3
                                    ];
                                    $linesId[31] = [
                                        4, 
                                        4, 
                                        4, 
                                        3, 
                                        2
                                    ];
                                    $linesId[32] = [
                                        2, 
                                        1, 
                                        1, 
                                        2, 
                                        3
                                    ];
                                    $linesId[33] = [
                                        3, 
                                        4, 
                                        4, 
                                        3, 
                                        2
                                    ];
                                    $linesId[34] = [
                                        1, 
                                        2, 
                                        2, 
                                        3, 
                                        4
                                    ];
                                    $linesId[35] = [
                                        4, 
                                        3, 
                                        3, 
                                        2, 
                                        1
                                    ];
                                    $linesId[36] = [
                                        2, 
                                        1, 
                                        2, 
                                        3, 
                                        4
                                    ];
                                    $linesId[37] = [
                                        3, 
                                        4, 
                                        3, 
                                        2, 
                                        1
                                    ];
                                    $linesId[38] = [
                                        1, 
                                        2, 
                                        3, 
                                        4, 
                                        3
                                    ];
                                    $linesId[39] = [
                                        4, 
                                        3, 
                                        2, 
                                        1, 
                                        2
                                    ];
                                    if( $postData['slotEvent'] != 'freespin' ) 
                                    {
                                        if( !isset($postData['slotEvent']) ) 
                                        {
                                            $postData['slotEvent'] = 'bet';
                                        }
                                        $slotSettings->SetBalance(-1 * $allbet, $postData['slotEvent']);
                                        $bankSum = $allbet / 100 * $slotSettings->GetPercent();
                                        $slotSettings->SetBank((isset($postData['slotEvent']) ? $postData['slotEvent'] : ''), $bankSum, $postData['slotEvent']);
                                        $slotSettings->UpdateJackpots($allbet);
                                        $slotSettings->SetGameData('ShiningJewels40CTBonusWin', 0);
                                        $slotSettings->SetGameData('ShiningJewels40CTFreeGames', 0);
                                        $slotSettings->SetGameData('ShiningJewels40CTCurrentFreeGame', 0);
                                        $slotSettings->SetGameData('ShiningJewels40CTCurrentFreeGame0', 0);
                                        $slotSettings->SetGameData('ShiningJewels40CTTotalWin', 0);
                                        $slotSettings->SetGameData('ShiningJewels40CTFreeBalance', sprintf('%01.2f', $slotSettings->GetBalance()) * 100);
                                        $slotSettings->SetGameData($slotSettings->slotId . 'Denom', $denom);
                                        $slotSettings->SetGameData($slotSettings->slotId . 'Lines', $lines);
                                        $slotSettings->SetGameData($slotSettings->slotId . 'Bet', $betline);
                                        $bonusMpl = 1;
                                    }
                                    else
                                    {
                                        $slotSettings->SetGameData('ShiningJewels40CTCurrentFreeGame', $slotSettings->GetGameData('ShiningJewels40CTCurrentFreeGame') + 1);
                                        $bonusMpl = $slotSettings->slotFreeMpl;
                                    }
                                    $balanceInCents = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                                    $winTypeTmp = $slotSettings->GetSpinSettings($postData['slotEvent'], $allbet, $lines);
                                    $winType = $winTypeTmp[0];
                                    $spinWinLimit = $winTypeTmp[1];
                                    if( $postData['slotEvent'] == 'freespin' && $winType == 'bonus' ) 
                                    {
                                        $winType = 'none';
                                    }
                                    for( $i = 0; $i <= 2000; $i++ ) 
                                    {
                                        $totalWin = 0;
                                        $lineWins = [];
                                        $cWins = [
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0, 
                                            0
                                        ];
                                        $wild = ['10'];
                                        $scatter = '1';
                                        $reels = $slotSettings->GetReelStrips($winType, $postData['slotEvent']);
                                        for( $k = 0; $k < $lines; $k++ ) 
                                        {
                                            $tmpStringWin = '';
                                            for( $j = 0; $j < count($slotSettings->SymbolGame); $j++ ) 
                                            {
                                                $csym = (string)$slotSettings->SymbolGame[$j];
                                                if( $csym == $scatter || !isset($slotSettings->Paytable['SYM_' . $csym]) ) 
                                                {
                                                }
                                                else
                                                {
                                                    $s = [];
                                                    $s[0] = $reels['reel1'][$linesId[$k][0] - 1];
                                                    $s[1] = $reels['reel2'][$linesId[$k][1] - 1];
                                                    $s[2] = $reels['reel3'][$linesId[$k][2] - 1];
                                                    $s[3] = $reels['reel4'][$linesId[$k][3] - 1];
                                                    $s[4] = $reels['reel5'][$linesId[$k][4] - 1];
                                                    if( ($s[0] == $csym || in_array($s[0], $wild)) && ($s[1] == $csym || in_array($s[1], $wild)) ) 
                                                    {
                                                        $mpl = 1;
                                                        if( in_array($s[0], $wild) && in_array($s[1], $wild) ) 
                                                        {
                                                            $mpl = 1;
                                                        }
                                                        else if( in_array($s[0], $wild) || in_array($s[1], $wild) ) 
                                                        {
                                                            $mpl = $slotSettings->slotWildMpl;
                                                        }
                                                        $tmpWin = $slotSettings->Paytable['SYM_' . $csym][2] * $betline * $mpl * $bonusMpl;
                                                        if( $cWins[$k] < $tmpWin ) 
                                                        {
                                                            $cWins[$k] = $tmpWin;
                                                            $fc = $slotSettings->Paytable['SYM_' . $csym][2];
                                                            $tmpStringWin = (object)[
                                                                'factor' => $fc, 
                                                                'msgs' => null, 
                                                                'wilds' => [], 
                                                                'symbol_count' => '2', 
                                                                'positions' => [
                                                                    0, 
                                                                    1
                                                                ], 
                                                                'symbols' => [
                                                                    '' . $csym, 
                                                                    '' . $csym
                                                                ], 
                                                                'paytable_factor' => $fc, 
                                                                'win' => sprintf('%01.2f', $tmpWin / $denom), 
                                                                'symbol' => '' . $csym, 
                                                                'subgame_win_factor' => 1, 
                                                                'line_number' => $k
                                                            ];
                                                        }
                                                    }
                                                    if( ($s[0] == $csym || in_array($s[0], $wild)) && ($s[1] == $csym || in_array($s[1], $wild)) && ($s[2] == $csym || in_array($s[2], $wild)) ) 
                                                    {
                                                        $mpl = 1;
                                                        if( in_array($s[0], $wild) && in_array($s[1], $wild) && in_array($s[2], $wild) ) 
                                                        {
                                                            $mpl = 1;
                                                        }
                                                        else if( in_array($s[0], $wild) || in_array($s[1], $wild) || in_array($s[2], $wild) ) 
                                                        {
                                                            $mpl = $slotSettings->slotWildMpl;
                                                        }
                                                        $tmpWin = $slotSettings->Paytable['SYM_' . $csym][3] * $betline * $mpl * $bonusMpl;
                                                        if( $cWins[$k] < $tmpWin ) 
                                                        {
                                                            $cWins[$k] = $tmpWin;
                                                            $fc = $slotSettings->Paytable['SYM_' . $csym][3];
                                                            $tmpStringWin = (object)[
                                                                'factor' => $fc, 
                                                                'msgs' => null, 
                                                                'wilds' => [], 
                                                                'symbol_count' => '3', 
                                                                'positions' => [
                                                                    0, 
                                                                    1, 
                                                                    2
                                                                ], 
                                                                'symbols' => [
                                                                    '' . $csym, 
                                                                    '' . $csym, 
                                                                    '' . $csym
                                                                ], 
                                                                'paytable_factor' => $fc, 
                                                                'win' => sprintf('%01.2f', $tmpWin / $denom), 
                                                                'symbol' => '' . $csym, 
                                                                'subgame_win_factor' => 1, 
                                                                'line_number' => $k
                                                            ];
                                                        }
                                                    }
                                                    if( ($s[0] == $csym || in_array($s[0], $wild)) && ($s[1] == $csym || in_array($s[1], $wild)) && ($s[2] == $csym || in_array($s[2], $wild)) && ($s[3] == $csym || in_array($s[3], $wild)) ) 
                                                    {
                                                        $mpl = 1;
                                                        if( in_array($s[0], $wild) && in_array($s[1], $wild) && in_array($s[2], $wild) && in_array($s[3], $wild) ) 
                                                        {
                                                            $mpl = 1;
                                                        }
                                                        else if( in_array($s[0], $wild) || in_array($s[1], $wild) || in_array($s[2], $wild) || in_array($s[3], $wild) ) 
                                                        {
                                                            $mpl = $slotSettings->slotWildMpl;
                                                        }
                                                        $tmpWin = $slotSettings->Paytable['SYM_' . $csym][4] * $betline * $mpl * $bonusMpl;
                                                        if( $cWins[$k] < $tmpWin ) 
                                                        {
                                                            $cWins[$k] = $tmpWin;
                                                            $fc = $slotSettings->Paytable['SYM_' . $csym][4];
                                                            $tmpStringWin = (object)[
                                                                'factor' => $fc, 
                                                                'msgs' => null, 
                                                                'wilds' => [], 
                                                                'symbol_count' => '4', 
                                                                'positions' => [
                                                                    0, 
                                                                    1, 
                                                                    2, 
                                                                    3
                                                                ], 
                                                                'symbols' => [
                                                                    '' . $csym, 
                                                                    '' . $csym, 
                                                                    '' . $csym, 
                                                                    '' . $csym
                                                                ], 
                                                                'paytable_factor' => $fc, 
                                                                'win' => sprintf('%01.2f', $tmpWin / $denom), 
                                                                'symbol' => '' . $csym, 
                                                                'subgame_win_factor' => 1, 
                                                                'line_number' => $k
                                                            ];
                                                        }
                                                    }
                                                    if( ($s[0] == $csym || in_array($s[0], $wild)) && ($s[1] == $csym || in_array($s[1], $wild)) && ($s[2] == $csym || in_array($s[2], $wild)) && ($s[3] == $csym || in_array($s[3], $wild)) && ($s[4] == $csym || in_array($s[4], $wild)) ) 
                                                    {
                                                        $mpl = 1;
                                                        if( in_array($s[0], $wild) && in_array($s[1], $wild) && in_array($s[2], $wild) && in_array($s[3], $wild) && in_array($s[4], $wild) ) 
                                                        {
                                                            $mpl = 1;
                                                        }
                                                        else if( in_array($s[0], $wild) || in_array($s[1], $wild) || in_array($s[2], $wild) || in_array($s[3], $wild) || in_array($s[4], $wild) ) 
                                                        {
                                                            $mpl = $slotSettings->slotWildMpl;
                                                        }
                                                        $tmpWin = $slotSettings->Paytable['SYM_' . $csym][5] * $betline * $mpl * $bonusMpl;
                                                        if( $cWins[$k] < $tmpWin ) 
                                                        {
                                                            $fc = $slotSettings->Paytable['SYM_' . $csym][5];
                                                            $cWins[$k] = $tmpWin;
                                                            $tmpStringWin = (object)[
                                                                'factor' => $fc, 
                                                                'msgs' => null, 
                                                                'wilds' => [], 
                                                                'symbol_count' => '5', 
                                                                'positions' => [
                                                                    0, 
                                                                    1, 
                                                                    2, 
                                                                    3, 
                                                                    4
                                                                ], 
                                                                'symbols' => [
                                                                    '' . $csym, 
                                                                    '' . $csym, 
                                                                    '' . $csym, 
                                                                    '' . $csym, 
                                                                    '' . $csym
                                                                ], 
                                                                'paytable_factor' => $fc, 
                                                                'win' => sprintf('%01.2f', $tmpWin / $denom), 
                                                                'symbol' => '' . $csym, 
                                                                'subgame_win_factor' => 1, 
                                                                'line_number' => $k
                                                            ];
                                                        }
                                                    }
                                                }
                                            }
                                            if( $cWins[$k] > 0 && $tmpStringWin != '' ) 
                                            {
                                                array_push($lineWins, $tmpStringWin);
                                                $totalWin += $cWins[$k];
                                            }
                                        }
                                        $scattersWin = 0;
                                        $scattersStr = '';
                                        $scattersCount = 0;
                                        $scPos = [];
                                        for( $r = 1; $r <= 5; $r++ ) 
                                        {
                                            for( $p = 0; $p <= 3; $p++ ) 
                                            {
                                                if( $reels['reel' . $r][$p] == $scatter ) 
                                                {
                                                    $scattersCount++;
                                                    $scPos[] = [
                                                        $p, 
                                                        $r - 1
                                                    ];
                                                }
                                            }
                                        }
                                        $scattersWin = $slotSettings->Paytable['SYM_' . $scatter][$scattersCount] * $allbet;
                                        if( $scattersCount >= 3 ) 
                                        {
                                            $sgwin = $slotSettings->slotFreeCount;
                                            $scattersStr = [
                                                [
                                                    'symbol' => '1', 
                                                    'bonus_value' => 0, 
                                                    'msgs' => null, 
                                                    'paytable_factor' => $slotSettings->Paytable['SYM_' . $scatter][$scattersCount], 
                                                    'subgame_win_factor' => 1, 
                                                    'count' => '' . $scattersCount, 
                                                    'positions' => $scPos, 
                                                    'win' => '' . ($scattersWin / $denom), 
                                                    'increase_factor_bonus' => [], 
                                                    'wild_exists' => null, 
                                                    'factor' => '' . $slotSettings->Paytable['SYM_' . $scatter][$scattersCount], 
                                                    'wilds' => null, 
                                                    'symbols_positions' => [
                                                        1 => ['positions' => $scPos]
                                                    ]
                                                ]
                                            ];
                                        }
                                        $totalWin += $scattersWin;
                                        if( $i > 1000 ) 
                                        {
                                            $winType = 'none';
                                        }
                                        if( $i > 1500 ) 
                                        {
                                            $response = '{"responseEvent":"error","responseType":"","serverResponse":"' . $totalWin . ' Bad Reel Strip"}';
                                            exit( $response );
                                        }
                                        if( $slotSettings->MaxWin < ($totalWin * $slotSettings->CurrentDenom) ) 
                                        {
                                        }
                                        else
                                        {
                                            $minWin = $slotSettings->GetRandomPay();
                                            if( $i > 700 ) 
                                            {
                                                $minWin = 0;
                                            }
                                            if( $slotSettings->increaseRTP && $winType == 'win' && $totalWin < ($minWin * $allbet) ) 
                                            {
                                            }
                                            else if( $totalWin <= $spinWinLimit && $winType == 'bonus' ) 
                                            {
                                                $cBank = $slotSettings->GetBank((isset($postData['slotEvent']) ? $postData['slotEvent'] : ''));
                                                if( $cBank < $spinWinLimit ) 
                                                {
                                                    $spinWinLimit = $cBank;
                                                }
                                                else
                                                {
                                                    break;
                                                }
                                            }
                                            else if( $totalWin > 0 && $totalWin <= $spinWinLimit && $winType == 'win' ) 
                                            {
                                                $cBank = $slotSettings->GetBank((isset($postData['slotEvent']) ? $postData['slotEvent'] : ''));
                                                if( $cBank < $spinWinLimit ) 
                                                {
                                                    $spinWinLimit = $cBank;
                                                }
                                                else
                                                {
                                                    break;
                                                }
                                            }
                                            else if( $totalWin == 0 && $winType == 'none' ) 
                                            {
                                                break;
                                            }
                                        }
                                    }
                                    $totalWin = sprintf('%01.2f', $totalWin);
                                    if( $totalWin > 0 ) 
                                    {
                                        $slotSettings->SetBank((isset($postData['slotEvent']) ? $postData['slotEvent'] : ''), -1 * $totalWin);
                                        if( $postData['slotEvent'] != 'freespin' ) 
                                        {
                                            $slotSettings->SetBalance($totalWin);
                                        }
                                        if( $postData['slotEvent'] != 'freespin' ) 
                                        {
                                            $responseData['play'][0]['result'][1] = (object)[
                                                'continue_params' => [
                                                    [
                                                        'label' => 'double_betpart', 
                                                        'values' => [
                                                            'skip', 
                                                            'half', 
                                                            'all'
                                                        ]
                                                    ], 
                                                    [
                                                        'label' => 'double_key', 
                                                        'values' => [
                                                            'red', 
                                                            'black', 
                                                            'diamond', 
                                                            'heart', 
                                                            'spade', 
                                                            'clubs'
                                                        ]
                                                    ]
                                                ], 
                                                'type' => 'can_play_red_black_double', 
                                                'wait_for_continue' => true, 
                                                'type_descr' => 'SELECT DOUBLE', 
                                                'start_subgame_timestamp' => null, 
                                                'step_number' => 1, 
                                                'double_cards_history' => [], 
                                                'end_subgame_timestamp' => null
                                            ];
                                        }
                                    }
                                    $reportWin = $totalWin;
                                    if( $postData['slotEvent'] == 'freespin' ) 
                                    {
                                        $slotSettings->SetGameData('ShiningJewels40CTBonusWin', $slotSettings->GetGameData('ShiningJewels40CTBonusWin') + $totalWin);
                                        $slotSettings->SetGameData('ShiningJewels40CTTotalWin', $slotSettings->GetGameData('ShiningJewels40CTTotalWin') + $totalWin);
                                        $balanceInCents = $slotSettings->GetGameData('ShiningJewels40CTFreeBalance');
                                    }
                                    else
                                    {
                                        $slotSettings->SetGameData('ShiningJewels40CTTotalWin', $totalWin);
                                    }
                                    $fs = 0;
                                    if( $scattersCount >= 3 ) 
                                    {
                                        $responseData['play'][0]['result'][0]['scatters_win'] = $scattersStr;
                                    }
                                    $winString = json_encode($lineWins);
                                    $jsSpin = '' . json_encode($reels) . '';
                                    $jsJack = '' . json_encode($slotSettings->Jackpots) . '';
                                    $slotSettings->SetGameData($slotSettings->slotId . 'Reels', $reels);
                                    $winstring = '';
                                    $slotSettings->SetGameData('ShiningJewels40CTGambleStep', 5);
                                    $hist = $slotSettings->GetGameData('ShiningJewels40CTCards');
                                    if( $postData['slotEvent'] == 'freespin' ) 
                                    {
                                        $state = 'freespin';
                                        $responseData['play'][0]['result'][$spinLoop] = $responseData['free_spin_result'];
                                        $responseData['play'][0]['result'][$spinLoop]['type_descr'] = 'FREE GAME';
                                        $responseData['play'][0]['result'][$spinLoop]['free_game_total'] = $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames');
                                        $responseData['play'][0]['result'][$spinLoop]['subgame_label_game_number'] = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame');
                                        $responseData['play'][0]['result'][$spinLoop]['free_game_number'] = $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame');
                                        $responseData['play'][0]['result'][$spinLoop]['free_games'] = 0;
                                        $responseData['play'][0]['result'][$spinLoop]['is_free'] = true;
                                        $responseData['play'][0]['result'][$spinLoop]['is_last'] = false;
                                        $responseData['play'][0]['result'][$spinLoop]['subgame_label'] = 'free';
                                        if( $slotSettings->GetGameData($slotSettings->slotId . 'FreeGames') <= $slotSettings->GetGameData($slotSettings->slotId . 'CurrentFreeGame') && $slotSettings->GetGameData('ShiningJewels40CTBonusWin') > 0 ) 
                                        {
                                            $responseData['play'][0]['result'][$spinLoop]['is_free'] = true;
                                            $responseData['play'][0]['result'][$spinLoop]['is_last'] = true;
                                            $postData['slotEvent'] = 'bet';
                                            $reportWin = 0;
                                        }
                                    }
                                    $responseData['play'][0]['account_status']['credit'] = round($balanceInCents);
                                    $responseData['play'][0]['account_status']['rgs_balance'] = round($balanceInCents);
                                    $responseData['play'][0]['result'][$spinLoop]['stop_reels'][0] = $reels['reel1'];
                                    $responseData['play'][0]['result'][$spinLoop]['stop_reels'][1] = $reels['reel2'];
                                    $responseData['play'][0]['result'][$spinLoop]['stop_reels'][2] = $reels['reel3'];
                                    $responseData['play'][0]['result'][$spinLoop]['stop_reels'][3] = $reels['reel4'];
                                    $responseData['play'][0]['result'][$spinLoop]['stop_reels'][4] = $reels['reel5'];
                                    $responseData['play'][0]['result'][$spinLoop]['result_reels'][0] = [
                                        $reels['reel1'][0], 
                                        $reels['reel2'][0], 
                                        $reels['reel3'][0], 
                                        $reels['reel4'][0], 
                                        $reels['reel5'][0]
                                    ];
                                    $responseData['play'][0]['result'][$spinLoop]['result_reels'][1] = [
                                        $reels['reel1'][1], 
                                        $reels['reel2'][1], 
                                        $reels['reel3'][1], 
                                        $reels['reel4'][1], 
                                        $reels['reel5'][1]
                                    ];
                                    $responseData['play'][0]['result'][$spinLoop]['result_reels'][2] = [
                                        $reels['reel1'][2], 
                                        $reels['reel2'][2], 
                                        $reels['reel3'][2], 
                                        $reels['reel4'][2], 
                                        $reels['reel5'][2]
                                    ];
                                    $responseData['play'][0]['result'][$spinLoop]['result_reels'][3] = [
                                        $reels['reel1'][3], 
                                        $reels['reel2'][3], 
                                        $reels['reel3'][3], 
                                        $reels['reel4'][3], 
                                        $reels['reel5'][3]
                                    ];
                                    $responseData['play'][0]['result'][$spinLoop]['request_params']['line_bet'] = $betline;
                                    $responseData['play'][0]['result'][$spinLoop]['request_params']['game_denom'] = $denom;
                                    $responseData['play'][0]['result'][$spinLoop]['request_params']['lines'] = $lines;
                                    $responseData['play'][0]['result'][$spinLoop]['request_params']['total_bet'] = $allbet;
                                    $responseData['play'][0]['result'][$spinLoop]['lines_win'] = $lineWins;
                                    $responseData['play'][0]['result'][$spinLoop]['winType '] = $winType;
                                    $responseData['play'][0]['result'][$spinLoop]['win'] = sprintf('%01.2f', $totalWin / $denom);
                                    $responseData['play'][0]['result'][$spinLoop]['total_win'] = $slotSettings->GetGameData('ShiningJewels40CTTotalWin') / $denom;
                                    $responseData['play'][0]['result'][$spinLoop]['total_win'] = sprintf('%01.2f', $responseData['play'][0]['result'][$spinLoop]['total_win']);
                                    if( $spinLoop == 0 && $winType == 'bonus' ) 
                                    {
                                        $postData['slotEvent'] = 'freespin';
                                        $spinLoopLimit += $slotSettings->slotFreeCount;
                                    }
                                }
                                $slotSettings->SetGameData($slotSettings->slotId . 'Results', $responseData['play'][0]['result']);
                                $response = '{"responseEvent":"spin","responseType":"' . $postData['slotEvent'] . '","serverResponse":{"result":' . json_encode($responseData['play'][0]['result']) . ',"slotDenom":' . $denom . ',"slotLines":' . $lines . ',"slotBet":' . $betline . ',"totalFreeGames":' . $slotSettings->GetGameData('ShiningJewels40CTFreeGames') . ',"currentFreeGames":' . $slotSettings->GetGameData('ShiningJewels40CTCurrentFreeGame0') . ',"Balance":' . $slotSettings->GetGameData($slotSettings->slotId . 'FreeBalance') . ',"afterBalance":' . $slotSettings->GetBalance() . ',"bonusWin":' . $slotSettings->GetGameData('ShiningJewels40CTBonusWin') . ',"totalWin":' . $totalWin . ',"winLines":[],"Jackpots":' . $jsJack . ',"reelsSymbols":' . $jsSpin . '}}';
                                $slotSettings->SaveLogReport($response, $allbet, $lines, $reportWin, $postData['slotEvent']);
                                $result_tmp[] = json_encode($responseData['play']);
                                break;
                            case 'gamble':
                                $Balance = $slotSettings->GetBalance();
                                $denom = $slotSettings->GetGameData($slotSettings->slotId . 'Denom');
                                if( $postData['continue_params']['double_key'] != 'red' && $postData['continue_params']['double_key'] != 'black' ) 
                                {
                                    $isGambleWin = rand(1, $slotSettings->GetGambleSettings() * 2);
                                }
                                else
                                {
                                    $isGambleWin = rand(1, $slotSettings->GetGambleSettings());
                                }
                                $dealerCard = '';
                                $totalWin = $slotSettings->GetGameData('ShiningJewels40CTTotalWin');
                                $gambleWin = 0;
                                $statBet = $totalWin;
                                if( $postData['continue_params']['double_betpart'] == 'half' ) 
                                {
                                    $totalWin = sprintf('%01.2f', $totalWin / 2);
                                    $statBet = $totalWin;
                                }
                                $hist = $slotSettings->GetGameData('ShiningJewels40CTCards');
                                $slotSettings->SetGameData('ShiningJewels40CTGambleStep', $slotSettings->GetGameData('ShiningJewels40CTGambleStep') - 1);
                                if( $slotSettings->MaxWin < ($totalWin * $slotSettings->CurrentDenom) ) 
                                {
                                    $isGambleWin = 0;
                                }
                                if( $slotSettings->GetBank((isset($postData['slotEvent']) ? $postData['slotEvent'] : '')) < ($totalWin * 2) ) 
                                {
                                    $isGambleWin = 0;
                                }
                                if( $isGambleWin == 1 ) 
                                {
                                    $gambleState = 'gamble';
                                    $responseData['gamble'][0]['result'][0]['double_result'] = 'win';
                                    if( $postData['continue_params']['double_key'] != 'red' && $postData['continue_params']['double_key'] != 'black' ) 
                                    {
                                        $gambleWin = $totalWin * 2;
                                        $totalWin = $totalWin * 4;
                                        if( $postData['continue_params']['double_key'] == 'diamond' ) 
                                        {
                                            $dealerCard = rand(0, 12);
                                        }
                                        if( $postData['continue_params']['double_key'] == 'heart' ) 
                                        {
                                            $dealerCard = rand(13, 25);
                                        }
                                        if( $postData['continue_params']['double_key'] == 'spade' ) 
                                        {
                                            $dealerCard = rand(26, 38);
                                        }
                                        if( $postData['continue_params']['double_key'] == 'clubs' ) 
                                        {
                                            $dealerCard = rand(39, 51);
                                        }
                                    }
                                    else
                                    {
                                        $gambleWin = $totalWin;
                                        $totalWin = $totalWin * 2;
                                        if( $postData['continue_params']['double_key'] == 'red' ) 
                                        {
                                            $dealerCard = rand(0, 25);
                                        }
                                        else
                                        {
                                            $dealerCard = rand(26, 51);
                                        }
                                    }
                                    array_pop($hist);
                                    array_unshift($hist, $dealerCard);
                                    $responseData['gamble'][0]['result'][1] = (object)[
                                        'type' => 'can_play_red_black_double', 
                                        'continue_params' => [
                                            [
                                                'values' => [
                                                    'skip', 
                                                    'half', 
                                                    'all'
                                                ], 
                                                'label' => 'double_betpart'
                                            ], 
                                            [
                                                'values' => [
                                                    'red', 
                                                    'black', 
                                                    'diamond', 
                                                    'heart', 
                                                    'spade', 
                                                    'clubs'
                                                ], 
                                                'label' => 'double_key'
                                            ]
                                        ], 
                                        'double_cards_history' => $hist, 
                                        'start_subgame_timestamp' => null, 
                                        'step_number' => 3, 
                                        'end_subgame_timestamp' => null, 
                                        'wait_for_continue' => true, 
                                        'type_descr' => 'SELECT DOUBLE'
                                    ];
                                }
                                else
                                {
                                    $gambleState = 'idle';
                                    $responseData['gamble'][0]['result'][0]['double_result'] = 'lost';
                                    $gambleWin = -1 * $totalWin;
                                    $totalWin = 0;
                                    $slotSettings->SetGameData('ShiningJewels40CTGambleStep', 0);
                                    if( $postData['continue_params']['double_key'] != 'red' && $postData['continue_params']['double_key'] != 'black' ) 
                                    {
                                        if( $postData['continue_params']['double_key'] == 'diamond' ) 
                                        {
                                            $dealerCard = rand(13, 51);
                                        }
                                        if( $postData['continue_params']['double_key'] == 'heart' ) 
                                        {
                                            $dealerCard = rand(26, 51);
                                        }
                                        if( $postData['continue_params']['double_key'] == 'spade' ) 
                                        {
                                            $dealerCard = rand(0, 26);
                                        }
                                        if( $postData['continue_params']['double_key'] == 'clubs' ) 
                                        {
                                            $dealerCard = rand(0, 38);
                                        }
                                    }
                                    else if( $postData['continue_params']['double_key'] == 'red' ) 
                                    {
                                        $dealerCard = rand(26, 51);
                                    }
                                    else
                                    {
                                        $dealerCard = rand(0, 25);
                                    }
                                    array_pop($hist);
                                    array_unshift($hist, $dealerCard);
                                }
                                $responseData['gamble'][0]['result'][0]['request_params']['double_key'] = $postData['continue_params']['double_key'];
                                $responseData['gamble'][0]['result'][0]['double_win'] = sprintf('%01.2f', $totalWin / $denom);
                                $responseData['gamble'][0]['result'][0]['win'] = sprintf('%01.2f', $totalWin / $denom);
                                $responseData['gamble'][0]['result'][0]['double_cards_history'] = $hist;
                                $slotSettings->SetGameData('ShiningJewels40CTTotalWin', $totalWin);
                                $slotSettings->SetBalance($gambleWin);
                                $slotSettings->SetBank((isset($postData['slotEvent']) ? $postData['slotEvent'] : ''), $gambleWin * -1);
                                $afterBalance = $slotSettings->GetBalance();
                                $jsSet = '{"dealerCard":"' . $dealerCard . '","gambleState":"' . $gambleState . '","totalWin":' . $totalWin . ',"afterBalance":' . $afterBalance . ',"Balance":' . $Balance . '}';
                                $response = '{"responseEvent":"gambleResult","serverResponse":' . $jsSet . '}';
                                $slotSettings->SaveLogReport($response, $statBet, 1, $gambleWin, 'slotGamble');
                                $slotSettings->SetGameData('ShiningJewels40CTCards', $hist);
                                $result_tmp[] = json_encode($responseData['gamble']);
                                break;
                        }
                        if( !isset($result_tmp[0]) ) 
                        {
                            $response = '{"responseEvent":"error","responseType":"","serverResponse":"Invalid request state"}';
                            exit( $response );
                        }
                        $response = $result_tmp[0];
                        $slotSettings->SaveGameData();
                        $slotSettings->SaveGameDataStatic();
                        echo $response;
                    }
                    catch( \Exception $e ) 
                    {
                        if( isset($slotSettings) ) 
                        {
                            $slotSettings->InternalErrorSilent($e);
                        }
                        else
                        {
                            $strLog = '';
                            $strLog .= "\n";
                            $strLog .= ('{"responseEvent":"error","responseType":"' . $e . '","serverResponse":"InternalError","request":' . json_encode($_REQUEST) . ',"requestRaw":' . file_get_contents('php://input') . '}');
                            $strLog .= "\n";
                            $strLog .= ' ############################################### ';
                            $strLog .= "\n";
                            $slg = '';
                            if( file_exists(storage_path('logs/') . 'GameInternal.log') ) 
                            {
                                $slg = file_get_contents(storage_path('logs/') . 'GameInternal.log');
                            }
                            file_put_contents(storage_path('logs/') . 'GameInternal.log', $slg . $strLog);
                        }
                    }
                }, 5);
            }
            get_($request, $game);
        }
    }

}
