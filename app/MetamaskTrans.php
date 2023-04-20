<?php 
namespace VanguardLTE
{
    class MetamaskTrans extends \Illuminate\Database\Eloquent\Model
    {
        protected $table = 'metamask_trans';
        protected $fillable = [
            'user_id', 
            'from', 
            'to', 
            'amount', 
            'currency', 
            'hash'
        ];
    }

}
