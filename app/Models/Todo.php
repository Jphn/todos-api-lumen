<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
  use HasFactory;

  protected $table = 'todos';

  protected $fillable = [
    'title',
    'description',
    'done',
    'done_at'
  ];

  protected $casts = [
    'done' => 'boolean'
  ];

  public function toggle(): Todo
  {
    $this->done = !$this->done;
    ($this->done) ? $this->done_at = Carbon::now() : $this->done_at = null;
    return $this;
  }
}
