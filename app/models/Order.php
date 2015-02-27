<?php

class Order extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';
    
    // Add your validation rules here
    public static $rules = [
            // 'title' => 'required'
    ];
    
    // Don't forget to fill this array
    protected $fillable = [];
    
    /**
     * Define a many-to-one relationship
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function unit() {
        
        return $this->belongsTo('Unit');
        
    }
    
    /**
     * Define a many-to-one relationship
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function kind() {
        
        return $this->belongsTo('Kind');
        
    }
    
    /**
     * Define a many-to-one relationship
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function user() {
        
        return $this->belongsTo('User');
        
    }
    /**
     * Define a many-to-one relationship
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function category() {
        
        return $this->belongsTo('Category');
        
    }
    
    /**
     * Define a one-to-many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customers() {
        
        return $this->hasMany('Customer');
        
    }
    /**
     * Define a many-to-many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongToMany
     */
    public function purposes() {
        
        return $this->belongsToMany('Purpose', 'orders_purposes', 'order_id', 'purpose_id')->withTimestamps();
    }

}
