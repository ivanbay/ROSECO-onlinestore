<?php namespace Borla\Chikka\Adapters\Timestamp;

use Borla\Chikka\Base\Model;
use Carbon\Carbon;

/**
 * Timestamp Trait
 */

trait TimestampTrait {

  /**
   * Set timestamp
   */
  protected function setTimestampAttribute($value) {
    // If nothing
    if ( ! $value) {
      // Creat new 
      return new Carbon(null, $this->getTimezone());
    }
    // Use carbon
    return ($value instanceof Carbon) ? $value : Carbon::createFromTimestamp($value, $this->getTimezone());
  }

  /**
   * Get timezone
   */
  protected function getTimezone() {
    // Return
    return 'UTC';
  }

}