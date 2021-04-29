<?php


function similarityDistance($preferences, $person1, $person2)
  {
      $similar = array();
      $sum = 0;
      $alpha = 0;
      $beta = 0;

      foreach($preferences[$person2] as $key=>$value)
      {
          $alpha += $preferences[$person2][$key] * $preferences[$person2][$key];
      }

      foreach($preferences[$person1] as $key=>$value)
      {
          $beta += $preferences[$person1][$key] * $preferences[$person1][$key];
          if(array_key_exists($key, $preferences[$person2])) {
              $sum += $preferences[$person2][$key] * $preferences[$person1][$key];
          }
      }

      if($alpha === 0 || $beta === 0)
          return 0;

      return  $sum / sqrt($alpha) / sqrt($beta);
  }




  function getRecommendations($preferences, $person)
  {
      $total = array();
      $simSums = array();
      $ranks = array();
      $sim = 0;

      foreach($preferences as $otherPerson=>$values)
      {
          if($otherPerson != $person)
          {
              $sim=similarityDistance($preferences, $person, $otherPerson);
          }

          if($sim > 0)
          {
              foreach($preferences[$otherPerson] as $key=>$value)
              {
                  if(!array_key_exists($key, $preferences[$person]))
                  {
                      if(!array_key_exists($key, $total)) {
                          $total[$key] = 0;
                      }
                      $total[$key] += $preferences[$otherPerson][$key] * $sim;

                      if(!array_key_exists($key, $simSums)) {
                          $simSums[$key] = 0;
                      }
                      $simSums[$key] += $sim;
                  }
              }

          }
      }

      foreach($total as $key=>$value)
      {
          $ranks[$key] = $value / $simSums[$key];
      }

  array_multisort($ranks, SORT_DESC);
  return $ranks;

  }
