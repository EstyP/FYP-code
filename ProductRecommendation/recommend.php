<!-- Similarity measure -->

<?php

//$person1 and $person2 =  the two users being scored/ compared against one another
//$matrix  = 2d array where the multiple similary scores are being stored
//$key = index element of current array position
//$value = on each iteration, the value of the current element is assigned to $value


function similarity_distance($matrix,$person1,$person2)     // check similarity between two users by seeing if same gifts exist in the other persons array
{
      $similar=array();                                     //an array to store the similarity score of the current 2 users that are being compared
      $sum=0;

      foreach($matrix[$person1] as $key=>$value)            //foreach loops through each value in array
      {
        if(array_key_exists($key,$matrix[$person2]))        //if the same item exists in both persons array list, there is a similarity
        {
            $similar[$key]=1;                               //adds new element to the array
        }

      }

        if($similar==0)                                      //else if no similarity between the two users, no intelligent recommendation can be made
        {
          return 0;
        }


      foreach($matrix[$person1] as $key=>$value)                     //for users found to have similarities
      {
          if(array_key_exists($key,$matrix[$person2]))
          {
              $sum=$sum+pow($value-$matrix[$person2][$key],2);      //calculate Euclidean distance between users
          }
      }

        return 1/(1+sqrt($sum));                                    //Returns a distance-based similarity score for person1 and person2

}



function getRecommendation($matrix,$person)                             //users found to have similarities can now be compared against each other to generate recommendations
{
    $total=array();
    $simsums=array();
    $ranks=array();
    $sim = 0;


    foreach($matrix as $otherPerson=>$values)                           //where users who have bought the same gift exist as pairs in the array
    {
      if($otherPerson!=$person)                                         //interests arent exactly alike
      {
        $sim=similarity_distance($matrix,$person,$otherPerson);           //similarity score can be calculated
      }
        if($sim > 0)                                                        //if similarity exists (score of 0 would mean no similarity whatsoever)
        {
        foreach($matrix[$otherPerson] as $key=>$value)
        {
          if(!array_key_exists($key,$matrix[$person]))                      //determine if similar users has bought same gift. if so, don't take into account and skip over, as both have already purchased
            {
              if(!array_key_exists($key,$total))
              {
                $total[$key]=0;
              }
              $total[$key]+=$matrix[$otherPerson][$key]*$sim;                    //get other persons rating on the gift and store in total variable

              if(!array_key_exists($key,$simsums))
              {
                $simsums[$key]=0;
              }
              $simsums[$key]+=$sim;                                          //once all of above complete, calculate summation of all the similarities

            }

        }

      }
    }

    foreach($total as $key=>$value)
    {
      $ranks[$key]=$value/$simsums[$key]; //store final similarity value for each item in array


    }

    array_multisort($ranks,SORT_DESC); //return list of gifts with highest rated at the top

    return $ranks;

}

 ?>
