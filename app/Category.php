<?php

namespace App;

use App\Events\CategorySave;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
    use LogsActivity;
    use SoftDeletes;

     protected $fillable = ['category_name', 'price', 'category_logo'];
//    protected $guarded = ["price"];

    protected static $logAttributes = ['*'];

    // protected static $logFillable = true;
    protected static $logOnlyDirty = true;

    protected static $logName = "category";

    public function getDescriptionForEvent(string $event_name): string
    {
        return "Category model has been <span class='btn btn-sm btn-success'> {$event_name} </span> by <span class='btn btn-sm btn-primary'>" . \Auth::user()->name . "</span>, and IP is : <span class='btn btn-sm btn-info'>" . request()->getClientIp() . "</span>";
    }

//    public $dispatchesEvents = [
//        "saved" => CategorySave::class
//    ];
}
