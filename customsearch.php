<?php
//Extends your class from SearchAbstract
use SearchElastic\SearchAbstract\SearchAbstract;

class CustomSearch extends SearchAbstract
{
    /**
     * Write your own search method
     *
     * @param  string  $query
     * @return Result from elasticsearch
     */
    public function search($query)
    {
        $this->validate($query);
        //get the elasticsearch client from the base class
        $client = $this->client->getClient();
        $result = array();
        /* Write your own query*/
        $params = [
            //you can add your index directly here or use this function if you are planning to set it on runtime $search->setIndex("blog") and then use $this->client->getIndex() to get index
                'index' => $this->client->getIndex(),
            //you can add your type directly here or use this function if you are planning to set it on runtime using $search->setType("post") and then use $this->client->getIndex()    
                'type'  => $this->client->getType(), 
                'body'  => [
                    'query' => [
                        'common' => [ 
                            "question" => [
                                "query" => $query,
                                "cutoff_frequency" => 0.001,
                                // "low_freq_operator" => "or"
                                ]
                        ],
                    ],
                ],
            ];
        $query  = $client->search($params);
        // you can use the base method to extract result from the search or return the result directly    
        return $query;
        return  $this->extractResult($query); 
    }
}