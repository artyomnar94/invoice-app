<?php

namespace App\Http\Requests\enums;

enum InvoiceStateEnum
{
    case New;
    case PendingPayment;
    case Paid;
    case Cancelled;
}
