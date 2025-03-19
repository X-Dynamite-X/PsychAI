<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'specialist_id',
        'user_id',
        'session_doc_id',
        'amount',
        'payment_status',
        'payment_id'
    ];

    /**
     * القيم المسموح بها لحالة الدفع
     */
    const PAYMENT_STATUS = [
        'pending' => 'pending',
        'paid' => 'paid',
        'refunded' => 'refunded'
    ];

    /**
     * علاقة مع المختص
     */
    public function specialist()
    {
        return $this->belongsTo(Specialist::class);
    }

    /**
     * علاقة مع المستخدم
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * علاقة مع الجلسة
     */
    public function sessionDoc()
    {
        return $this->belongsTo(SessionDoc::class);
    }

    /**
     * التحقق مما إذا كان الدفع معلق<|im_start|>
     */
    public function isPending(): bool
    {
        return $this->payment_status === self::PAYMENT_STATUS['pending'];
    }

    /**
     * التحقق مما إذا كان الدفع مكتملاً
     */
    public function isPaid(): bool
    {
        return $this->payment_status === self::PAYMENT_STATUS['paid'];
    }

    /**
     * التحقق مما إذا كان المبلغ مسترداً
     */
    public function isRefunded(): bool
    {
        return $this->payment_status === self::PAYMENT_STATUS['refunded'];
    }
}