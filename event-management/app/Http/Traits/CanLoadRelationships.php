<?php

namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Model;
// Import the builder classes
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;


trait CanLoadRelationships
{
  public function CanLoadRelationships(
    // Load relationships for something - ether
    // model or query builder.
    Model|QueryBuilder|EloquentBuilder $for,
    // Relations parameter is useful is if you
    // want to customize what relations can be loaded
    // for every single action in controler.
    // Or we can use a field that is defined in a class.
    // So let's add a question mark making this input optional.
    // But if array can be not passed in you have to assign
    // null to it.
    ?array $relations = null
  ): Model|QueryBuilder|EloquentBuilder{
    // If relations is not set we use the field called relations
    // defined within the class the trait is used.
    // If no relations found then use empty array and foreach
    // loop won't do anything.
    $relations = $relations ?? $this->relations ?? [];

    // Copy the query from EventController.php
    foreach ($relations as $relation) {
      $for->when(
        $this->shouldIncludeRelation($relation),
        // If for variable is an instance of Model we do
        // q load because the model is already loaded so with
        // method is not avaible. Otherwise use with for query
        // builder
        fn($q) => $for instanceof Model ? $for->load($relation) : $q->with($relation),
      );
  }

  return $for;
  }

  protected function shouldIncludeRelation(string $relation): bool
    {
      // Using query method get query parameter 'include'.
      // We use here request function which gives you access
      // to the current request to no need to pass request object
      // to this method
      $include = request()->query('include');

      // If include is not set, return false meaning that this relation that was passed
      // as an argument should not be included
      if (!$include) {
          return false;
      }
      // trim is an inbuilt function in PHP that trims all empty spaces
      $relations = array_map('trim', explode(',', $include));

      // Check if specific relation past into this method is inside the
      // relations array
      return in_array($relation, $relations);

    }
}