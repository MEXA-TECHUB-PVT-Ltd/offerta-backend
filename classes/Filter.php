<?php
class Filter{
    public $id;
    public $user_id;
    public $sale_by;
    public $order_by;
    public $price;
    public $time;
    public $shipping_id;
    public $listing_id;
    public $category_id;
    public $agoTime;
    public $sort;
    public $distance;
    public $distance_lat;
    public $distance_log;
    public $conn;
    public $from_price;
    public $to_price;
    public $created_at;
    public $listing;
    public $offers_table;
    public $likes_table;
    public $exchange_table;
    public function __construct($db){
        $this->conn = $db;
        $this->listing = "listing";
        $this->offers_table = "offers";
        $this->likes_table = "likes";
        $this->exchange_table = "exchange";
        $this->created_at = date("Y-m-d h:i");
    }
    public function oneDayAgo(){
        $query = "SELECT * FROM ".$this->listing." ";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            // $r = mysqli_fetch_assoc($result);
            $rows = array();
            while ($r = mysqli_fetch_assoc($result)) {
                $created_at=$r["created_at"];
                $postTiming = date("Y-m-d", strtotime($created_at));
                $time = strtotime(date(("Y-m-d")));
                $oneDayAgo = date("Y-m-d", strtotime("-1 day", $time));
                if ($postTiming == $oneDayAgo) {
                    $id = $r["id"];
                    $user_id = $r["user_id"];
                    $title = $r["title"];
                    $description = $r["description"];
                    $price = $r["price"];
                    $location = $r["location"];
                    $product_condition = $r["product_condition"];
                    $exchange = $r["exchange"];
                    $fixed_price = $r["fixed_price"];
                    $giveaway = $r["giveaway"];
                    $shipping_cost = $r["shipping_cost"];
                    $sold = $r["sold"];
                    $youtube_link = $r["youtube_link"];
                    $created_at = $r["created_at"];
                    $category = $r["category_id"];
                    $subcategory = $r["subcategory_id"];
                $query2 = "SELECT * FROM product_images WHERE product_id = '$id'";
                    $result2 = mysqli_query($this->conn, $query2);
                    $rows2 = array();
                    while ($r2 = mysqli_fetch_assoc($result2)) {
                        $img = $r2["image"];
                        $rows2[] = $img;
                    }     
                    $data= array(
                        "id"=>$id,
                        "user_id"=>$user_id,
                        "title"=>$title,
                        "description"=>$description,
                        "price"=>$price,
                        "location"=>$location,
                        "product_condition"=>$product_condition,
                        "exchange"=>$exchange,
                        "fixed_price"=>$fixed_price,
                        "giveaway"=>$giveaway,
                        "shipping_cost"=>$shipping_cost,
                        "sold"=>$sold,
                        "youtube_link"=>$youtube_link,
                        "created_at"=>$created_at,
                        "category_id"=>$category,
                        "sub_category_id"=>$subcategory,
                        "images"=>$rows2
                );
                    $rows[] = $data;
                }
            }
            return $rows;
        }
    
        return array();
    }
    public function allProduct(){
            $query = "SELECT * FROM ".$this->listing." WHERE user_id = '$this->user_id' ORDER BY created_at DESC";
            $result = mysqli_query($this->conn, $query);
            if ($result) {
                if (mysqli_num_rows($result) >0) {
                while($r = mysqli_fetch_assoc($result)){
                $data = array();
                $id = $r["id"];
                $user_id = $r["user_id"];
                $title = $r["title"];
                $description = $r["description"];
                $price = $r["price"];
                $location = $r["location"];
                $location_lat = $r["location_lat"];
                $location_log = $r["location_log"];
                $num_lat = floatval($location_lat);
            $num_log = floatval($location_log);
                $product_condition = $r["product_condition"];
                $exchange = $r["exchange"];
                $fixed_price = $r["fixed_price"];
                $giveaway = $r["giveaway"];
                $shipping_cost = $r["shipping_cost"];
                $sold = $r["sold"];
                $youtube_link = $r["youtube_link"];
                $category = $r["category_id"];
                $subcategory = $r["subcategory_id"];
                $created_at = $r["created_at"];
                $query3 = "SELECT * FROM categories WHERE id = '$category'";
            $result3 = mysqli_query($this->conn, $query3);
            $r3 = mysqli_fetch_assoc($result3);
            $query4 = "SELECT * FROM sub_categories WHERE id = '$subcategory'";
            $result4 = mysqli_query($this->conn, $query4);
            $r4 = mysqli_fetch_assoc($result4);
            if (empty($r4["name"])) {
                # code...
                    $sub_category_name = null;
            }else{
            $sub_category_name = $r4["name"] ;
            }
            if (empty($r3["name"])) {
                # code...
                    $category_name = null;
            }else{
            $category_name = $r3["name"] ;
            }
                        $rows2 = array();
                        $query2 = "SELECT * FROM product_images WHERE product_id = '$id'";
                        $result2 = mysqli_query($this->conn, $query2);
                        while ($r2 = mysqli_fetch_assoc($result2)) {
                            $img = $r2["image"];
                            $rows2[] = $img;
                        }
                $data= array(
                        "id"=>$id,
                        "user_id"=>$user_id,
                        "title"=>$title,
                        "description"=>$description,
                        "price"=>$price,
                        "location"=>$location,
                        "location_lat"=>$num_lat,
                        "location_log"=>$num_log,
                        "product_condition"=>$product_condition,
                        "exchange"=>$exchange,
                        "fixed_price"=>$fixed_price,
                        "giveaway"=>$giveaway,
                        "shipping_cost"=>$shipping_cost,
                        "sold"=>$sold,
                        "youtube_link"=>$youtube_link,
                        "created_at"=>$created_at,
                        "category"=>array(
                            "category_id"=>$category,
                            "category_name"=>$category_name,
                        ),
                        "subcategory"=>array(
                            "sub_category_id"=>$subcategory,
                            "sub_category_name"=>$sub_category_name,
    
                        ),
                    "images"=>$rows2
                );
                        $array[] = $data;
            }
                    return $array;
            }else {
                return $data = array(
                    "status"=>true,
                    "message" => "No data available"
                );
        }
            }
        
            return array();
        }
    public function priceFilter(){
            $query = "SELECT * FROM ".$this->listing." WHERE price >= '$this->from_price' AND price <= '$this->to_price'";
            $result = mysqli_query($this->conn, $query);
            if ($result) {
                if (mysqli_num_rows($result) >0) {
                $rows2 = array();
                while($r = mysqli_fetch_assoc($result)){
                $data = array();
                $id = $r["id"];
                $user_id = $r["user_id"];
                $title = $r["title"];
                $description = $r["description"];
                $price = $r["price"];
                $location = $r["location"];
                $product_condition = $r["product_condition"];
                $exchange = $r["exchange"];
                $fixed_price = $r["fixed_price"];
                $giveaway = $r["giveaway"];
                $shipping_cost = $r["shipping_cost"];
                $sold = $r["sold"];
                $youtube_link = $r["youtube_link"];
                $category = $r["category_id"];
                $subcategory = $r["subcategory_id"];
                $created_at = $r["created_at"];
                $query3 = "SELECT * FROM categories WHERE id = '$category'";
                $result3 = mysqli_query($this->conn, $query3);
                $r3 = mysqli_fetch_assoc($result3);
                $category_name = $r3["name"];
                $query4 = "SELECT * FROM sub_categories WHERE id = '$subcategory'";
                $result4 = mysqli_query($this->conn, $query4);
                $r4 = mysqli_fetch_assoc($result4);
                $sub_category_name = $r4["name"];
                        $query2 = "SELECT * FROM product_images WHERE product_id = '$this->id'";
                        $result2 = mysqli_query($this->conn, $query2);
                        while ($r2 = mysqli_fetch_assoc($result2)) {
                            $img = $r2["image"];
                            $rows2[] = $img;
                        }
                $data= array(
                        "id"=>$id,
                        "user_id"=>$user_id,
                        "title"=>$title,
                        "description"=>$description,
                        "price"=>$price,
                        "location"=>$location,
                        "product_condition"=>$product_condition,
                        "exchange"=>$exchange,
                        "fixed_price"=>$fixed_price,
                        "giveaway"=>$giveaway,
                        "shipping_cost"=>$shipping_cost,
                        "sold"=>$sold,
                        "youtube_link"=>$youtube_link,
                        "created_at"=>$created_at,
                        "category"=>array(
                            "category_id"=>$category,
                            "category_name"=>$category_name,
                        ),
                        "subcategory"=>array(
                            "sub_category_id"=>$subcategory,
                            "sub_category_name"=>$sub_category_name,
    
                        ),
                    "images"=>$rows2
                );
                        $array[] = $data;
            }
                    return $array;
            }else {
                return $data = array(
                    "status"=>true,
                    "message" => "No data available"
                );
        }
            }
        
            return array();
        }
    public function InsightList(){
        $query2 = "SELECT * FROM ".$this->likes_table." WHERE list_id = '$this->listing_id'";
        $result2 = mysqli_query($this->conn, $query2);
        if ($result2) {
            $totalLiked = mysqli_num_rows($result2);
        }
        $query3 = "SELECT * FROM views WHERE listing_id = '$this->listing_id'";
        $result3 = mysqli_query($this->conn, $query3);
        if ($result3) {
            $totalView = mysqli_num_rows($result3);
            if ($totalView <= 20) {
                $populrity='low';
            }elseif ($totalView > 20 && $totalView < 30) {
                $populrity='medium';
            }else{
                $populrity='high';
            }
                
        }
        $query4 = "SELECT * FROM exchange WHERE item = '$this->listing_id' OR item2 = '$this->listing_id'";
        $result4 = mysqli_query($this->conn, $query4);
        if ($result4) {
            $totalExchange = mysqli_num_rows($result4);
        }
        $query5 = "SELECT * FROM offers WHERE listing_id = '$this->listing_id'";
        $result5 = mysqli_query($this->conn, $query5);
        if ($result5) {
            $totalOffer = mysqli_num_rows($result5);
        }
        $query6 = "SELECT * FROM comments WHERE listing_id = '$this->listing_id'";
        $result6 = mysqli_query($this->conn, $query6);
        if ($result5) {
            $totalComment = mysqli_num_rows($result6);
        }
        $query7 = "SELECT * FROM views WHERE listing_id = '$this->listing_id'";
        $result7 = mysqli_query($this->conn, $query7);
        if ($result7) {
            $array=array();
            $total_city = 0;
            while ($city = mysqli_fetch_assoc($result7)) {
                $user_id = $city["user_id"];
                $query07 = "SELECT * FROM logins WHERE id = '$user_id'";
                $result07 = mysqli_query($this->conn, $query07);
                $user_data = mysqli_fetch_assoc($result07);
                $vist_city = $user_data["city"];
                $country = $user_data["country"];
                $array[]=array(
                    "city"=>$vist_city,
                    "country"=>$country,
                    "count"=>1
                );
              }

              $total_visited_city = array();
              foreach ($array as $row) {
                $found = false;
                foreach ($total_visited_city as &$result) {
                    if ($result["city"] == $row["city"] && $result["country"] == $row["country"]) {
                        $result["count"]++;
                        $found = true;
                        break;
                    }
                }
                if (!$found) {
                    $total_visited_city[] = array(
                        "city" => $row["city"],
                        "country" => $row["country"],
                        "count" => 1
                    );
                $total_city++;
                }
            }
              
        }
        $abc=$total_visited_city;
        function compareCounts($a, $b) {
            return $b['count'] - $a['count'];
        }
        usort($abc, 'compareCounts');
        $abc = array_map(function($city) {
            unset($city['count']);
            return $city;
        }, $abc);
        $topFive = array_slice($abc, 0, 5);
        return array(
            "tatal_like"=>$totalLiked,
            "tatal_view"=>$totalView,
            "tatal_Exchange"=>$totalExchange,
            "tatal_comments"=>$totalComment,
            "popularity"=>$populrity,
            "Total_Visted_City"=>$total_city,
            "most_visted"=>$topFive,
        );
        
    }
    public function WeeklyInsightList(){
        $query = "SELECT * FROM ".$this->listing." WHERE user_id = '$this->user_id'";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            $data = array();
            while ($r = mysqli_fetch_assoc($result)) {
                $created_at=$r["created_at"];
                $postTiming = date("Y-m-d", strtotime($created_at));
                $time = strtotime(date(("Y-m-d")));
                $now = date("Y-m-d", strtotime("0 day", $time));
                $sevenDaysAgo = date("Y-m-d", strtotime("-7 day", $time));
                if ($postTiming <= $now && $postTiming >=$sevenDaysAgo) {
                    $list_id=$r["id"];
                    if (mysqli_num_rows($result) < 1) {
                        # code...
                        $total_list = 0;
                    }else {
                        # code...
                        $total_list = mysqli_num_rows($result);
                    }
                    // Total likes
                    $query2 = "SELECT * FROM ".$this->likes_table." WHERE list_id = '$list_id'";
                    $result2 = mysqli_query($this->conn, $query2);
                    if ($result2) {
                        if (mysqli_num_rows($result2) < 1) {
                            # code...
                            $totalLiked = 0;
                        }else{
                            if(mysqli_num_rows($result2) < 1){
                                $totalLiked = 0;
                            }else{
                                $totalLiked = mysqli_num_rows($result2);
                            }
                        }
                    }
                    // total exchange
                    $query3 = "SELECT * FROM ".$this->exchange_table." WHERE item2 = '$list_id'";
                    $result3 = mysqli_query($this->conn, $query3);
                    if ($result3) {
                        if (mysqli_num_rows($result3) < 1) {
                            # code...
                            $total_exchange_request=0;
                        }else {
                            # code...
                            $total_exchange_request = mysqli_num_rows($result3);
                        }
                    }
                    // total Comments
                    $query4 = "SELECT * FROM comments WHERE listing_id = '$list_id'";
                    $result4 = mysqli_query($this->conn, $query4);
                    if ($result4) {
                        if ( mysqli_num_rows($result4) < 1) {
                            # code...
                            $total_comments = 0;
                        }else{
                            $total_comments = mysqli_num_rows($result4);
                        }
                    }
                    $query5 = "SELECT * FROM ".$this->offers_table." WHERE listing_id = '$list_id'";
                    $result5 = mysqli_query($this->conn, $query5);
                    if ($result5) {
                        if (mysqli_num_rows($result5) < 1 ) {
                            # code...
                            $total_offers = 0;
                        }else{
                            $total_offers = mysqli_num_rows($result5);
                        }
                    }
                    $rows = array(
                        "Listing_id"=>"$list_id",
                        "total_lists"=>"$total_list",
                        "totalLiked"=>"$totalLiked",
                        "total_exchange_request"=>"$total_exchange_request",
                        "total_comments"=>"$total_comments",
                        "total_offers"=>"$total_offers"
                    );
                    $data[] = $rows;
                    $array = array(
                        "total_list"=>"$total_list",
                        "Lists"=>$data
                    );
                    return $array;
                }

            }
            
            
            
        }
        return array();
    }
    public function MonthlyInsightList(){
        $query = "SELECT * FROM ".$this->listing." WHERE user_id = '$this->user_id'";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            $data = array();
            while ($r = mysqli_fetch_assoc($result)) {
                $created_at=$r["created_at"];
                $postTiming = date("Y-m-d", strtotime($created_at));
                $time = strtotime(date(("Y-m-d")));
                $now = date("Y-m-d", strtotime("0 day", $time));
                $sevenDaysAgo = date("Y-m-d", strtotime("-30 day", $time));
                if ($postTiming <= $now && $postTiming >=$sevenDaysAgo) {
                    $list_id=$r["id"];
                    if (mysqli_num_rows($result) < 1) {
                        # code...
                        $total_list = 0;
                    }else {
                        # code...
                        $total_list = mysqli_num_rows($result);
                    }
                    // Total likes
                    $query2 = "SELECT * FROM ".$this->likes_table." WHERE list_id = '$list_id'";
                    $result2 = mysqli_query($this->conn, $query2);
                    if ($result2) {
                        if (mysqli_num_rows($result2) < 1) {
                            # code...
                            $totalLiked = 0;
                        }else{
                            if(mysqli_num_rows($result2) < 1){
                                $totalLiked = 0;
                            }else{
                                $totalLiked = mysqli_num_rows($result2);
                            }
                        }
                    }
                    // total exchange
                    $query3 = "SELECT * FROM ".$this->exchange_table." WHERE item2 = '$list_id'";
                    $result3 = mysqli_query($this->conn, $query3);
                    if ($result3) {
                        if (mysqli_num_rows($result3) < 1) {
                            # code...
                            $total_exchange_request=0;
                        }else {
                            # code...
                            $total_exchange_request = mysqli_num_rows($result3);
                        }
                    }
                    // total Comments
                    $query4 = "SELECT * FROM comments WHERE listing_id = '$list_id'";
                    $result4 = mysqli_query($this->conn, $query4);
                    if ($result4) {
                        if ( mysqli_num_rows($result4) < 1) {
                            # code...
                            $total_comments = 0;
                        }else{
                            $total_comments = mysqli_num_rows($result4);
                        }
                    }
                    $query5 = "SELECT * FROM ".$this->offers_table." WHERE listing_id = '$list_id'";
                    $result5 = mysqli_query($this->conn, $query5);
                    if ($result5) {
                        if (mysqli_num_rows($result5) < 1 ) {
                            # code...
                            $total_offers = 0;
                        }else{
                            $total_offers = mysqli_num_rows($result5);
                        }
                    }
                    $rows = array(
                        "Listing_id"=>"$list_id",
                        "total_lists"=>"$total_list",
                        "totalLiked"=>"$totalLiked",
                        "total_exchange_request"=>"$total_exchange_request",
                        "total_comments"=>"$total_comments",
                        "total_offers"=>"$total_offers"
                    );
                    $data[] = $rows;
                    $array = array(
                        "total_list"=>"$total_list",
                        "Lists"=>$data
                    );
                    
                    return $array;
                }

            }
           
        }
        return array();
    }
    public function YearlyInsightList(){
        $query = "SELECT * FROM ".$this->listing." WHERE user_id = '$this->user_id'";
        $result = mysqli_query($this->conn, $query);
        if ($result) {
            $data = array();
            while ($r = mysqli_fetch_assoc($result)) {
                $created_at=$r["created_at"];
                $postTiming = date("Y-m-d", strtotime($created_at));
                $time = strtotime(date(("Y-m-d")));
                $now = date("Y-m-d", strtotime("0 day", $time));
                $sevenDaysAgo = date("Y-m-d", strtotime("-12 month", $time));
                if ($postTiming <= $now && $postTiming >=$sevenDaysAgo) {
                    $list_id=$r["id"];
                    if (mysqli_num_rows($result) < 1) {
                        # code...
                        $total_list = 0;
                    }else {
                        # code...
                        $total_list = mysqli_num_rows($result);
                    }
                    // Total likes
                    $query2 = "SELECT * FROM ".$this->likes_table." WHERE list_id = '$list_id'";
                    $result2 = mysqli_query($this->conn, $query2);
                    if ($result2) {
                        if (mysqli_num_rows($result2) < 1) {
                            # code...
                            $totalLiked = 0;
                        }else{
                            if(mysqli_num_rows($result2) < 1){
                                $totalLiked = 0;
                            }else{
                                $totalLiked = mysqli_num_rows($result2);
                            }
                        }
                    }
                    // total exchange
                    $query3 = "SELECT * FROM ".$this->exchange_table." WHERE item2 = '$list_id'";
                    $result3 = mysqli_query($this->conn, $query3);
                    if ($result3) {
                        if (mysqli_num_rows($result3) < 1) {
                            # code...
                            $total_exchange_request=0;
                        }else {
                            # code...
                            $total_exchange_request = mysqli_num_rows($result3);
                        }
                    }
                    // total Comments
                    $query4 = "SELECT * FROM comments WHERE listing_id = '$list_id'";
                    $result4 = mysqli_query($this->conn, $query4);
                    if ($result4) {
                        if ( mysqli_num_rows($result4) < 1) {
                            # code...
                            $total_comments = 0;
                        }else{
                            $total_comments = mysqli_num_rows($result4);
                        }
                    }
                    $query5 = "SELECT * FROM ".$this->offers_table." WHERE listing_id = '$list_id'";
                    $result5 = mysqli_query($this->conn, $query5);
                    if ($result5) {
                        if (mysqli_num_rows($result5) < 1 ) {
                            # code...
                            $total_offers = 0;
                        }else{
                            $total_offers = mysqli_num_rows($result5);
                        }
                    }
                    $rows = array(
                        "Listing_id"=>"$list_id",
                        "total_lists"=>"$total_list",
                        "totalLiked"=>"$totalLiked",
                        "total_exchange_request"=>"$total_exchange_request",
                        "total_comments"=>"$total_comments",
                        "total_offers"=>"$total_offers"
                    );
                    $data[] = $rows;
                    $array = array(
                        "total_list"=>"$total_list",
                        "Lists"=>$data
                    );
                    
                    return $array;
                }

            }

        }
        return array();
    }


    public function Distance()
    {
        if (empty($this->sort) || $this->sort == 'a') {
            # code...
            $query = "SELECT * FROM ".$this->listing." ORDER BY title ASC";
        }else{
            $query = "SELECT * FROM ".$this->listing." ORDER BY created_at DESC";
        }
        $result = mysqli_query($this->conn, $query);
        define("EARTH_RADIUS", 6371);
        $filtered_products = array();
        while ($r = mysqli_fetch_assoc($result)) {
            $product_lat = $r['location_lat'];
            $product_lng = $r['location_log'];
            $lat_diff = deg2rad($product_lat - $this->distance_lat);
            $lng_diff = deg2rad($product_lng - $this->distance_log);
            $a = sin($lat_diff / 2) * sin($lat_diff / 2) + cos(deg2rad($this->distance_lat)) * cos(deg2rad($product_lat)) * sin($lng_diff / 2) * sin($lng_diff / 2);
            $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
            $distance = EARTH_RADIUS * $c;
            if (($distance <= $this->distance) || (empty($this->distance))) {
                if ((($this->category_id == $r["category_id"]) || empty($this->category_id)) && (empty($this->price) || $this->price == $r["price"])) {
                    if ($this->time == '1_day') {
                        $created_at=$r["created_at"];
                        $postTiming = date("Y-m-d", strtotime($created_at));
                        $time = strtotime(date(("Y-m-d")));
                        $oneDayAgo = date("Y-m-d", strtotime("-1 day", $time));
                        $today = date("Y-m-d", strtotime("0 day", $time));
                        if ($postTiming == $oneDayAgo || $postTiming == $today ) {
                            $filtered_products[] = $r;
                        }
                    }elseif ( $this->time == '7_day') {
                        $created_at=$r["created_at"];
                        $postTimingSeven = date("Y-m-d", strtotime($created_at));
                        $time = strtotime(date(("Y-m-d")));
                        $now = date("Y-m-d", strtotime("0 day", $time));
                        $sevenDaysAgo = date("Y-m-d", strtotime("-7 day", $time));
                        if ($postTimingSeven <= $now && $postTimingSeven >= $sevenDaysAgo) {
                            $filtered_products[] = $r;
                        }
                    } elseif ($this->time == 'month') {
                    $created_at=$r["created_at"];
                    $id=$r["id"];
                    $postTimingmonth = date("Y-m-d", strtotime($created_at));
                    $time = strtotime(date(("Y-m-d")));
                    $now = date("Y-m-d", strtotime("0 day", $time));
                    $MonthDaysAgo = date("Y-m-d", strtotime("-30 day", $time));
                        if ($postTimingmonth <= $now && $postTimingmonth >= $MonthDaysAgo) {
                            
                            $filtered_products[] = $r;
                        }
                    }elseif(empty($this->time)){
                        $filtered_products[] = $r;
                    }
                }
              }
              }
        return $filtered_products;
            
    }
















    public function ApplyFilter(){
        if (empty($this->sort)) {
            if (!empty($this->distance_lat && $this->distance_log)) {
                # code...
                $radius = 500; // Earth's radius in kilometers
                $maxLat = $this->distance_lat + rad2deg($radius / $radius);
                $minLat = $$this->distance_lat - rad2deg($radius / $radius);
                $maxLon = $$this->distance_log + rad2deg(asin($radius / $radius) / cos(deg2rad($this->distance_lat)));
                $minLon = $$this->distance_log - rad2deg(asin($radius / $radius) / cos(deg2rad($this->distance_lat)));
                $query = "SELECT * FROM ".$this->listing."  WHERE lat BETWEEN $minLat AND $maxLat AND log BETWEEN $minLon AND $maxLon";
                $result = mysqli_query($this->conn, $query);
            }else{
                $query = "SELECT * FROM ".$this->listing." ";
                $result = mysqli_query($this->conn, $query);
            }
        }else{
            if (!empty($this->distance_lat && $this->distance_log)) {
                # code...
                $radius = 500; // Earth's radius in kilometers
                $maxLat = $this->distance_lat + rad2deg($radius / $radius);
                $minLat = $$this->distance_lat - rad2deg($radius / $radius);
                $maxLon = $$this->distance_log + rad2deg(asin($radius / $radius) / cos(deg2rad($this->distance_lat)));
                $minLon = $$this->distance_log - rad2deg(asin($radius / $radius) / cos(deg2rad($this->distance_lat)));
                $query = "SELECT * FROM ".$this->listing."  WHERE lat BETWEEN $minLat AND $maxLat AND log BETWEEN $minLon AND $maxLon";
                $result = mysqli_query($this->conn, $query);
            }else{
                $query = "SELECT * FROM ".$this->listing." ";
                $result = mysqli_query($this->conn, $query);
            }
            $query = "SELECT * FROM ".$this->listing." WHERE title LIKE '".$this->sort."%' ";
            $result = mysqli_query($this->conn, $query);
        }
       
        if ($result) {
            $data = array();
            while ($r = mysqli_fetch_assoc($result)) {
                    if (($r["price"] == $this->price || empty($this->price)) && ($r["category_id"] == $this->category_id || empty($this->category_id)) && (($r["location_lat"] == $this->distance_lat) || (empty($this->distance_lat))) && ($r["location_log"] == $this->distance_log ||  empty($this->distance_log))) {
                        # code...
                        
                        $created_at=$r["created_at"];
                        if (empty($this->agoTime)) {
                        $filterTime = 0;
                        $postTiming = 0;
                            # code...
                        }else{
                            $postTiming = date("Y-m-d", strtotime($created_at));
                            $filterTime = date("Y-m-d", strtotime($this->agoTime));
                        }
                        if ($postTiming == $filterTime) {
                            # code...
                            $id = $r["id"];
                            $user_id = $r["user_id"];
                            $title = $r["title"];
                            $description = $r["description"];
                            $price = $r["price"];
                            $location = $r["location"];
                            $location_lat = $r["location_lat"];
                            $location_log = $r["location_log"];
                            $product_condition = $r["product_condition"];
                            $exchange = $r["exchange"];
                            $fixed_price = $r["fixed_price"];
                            $giveaway = $r["giveaway"];
                            $shipping_cost = $r["shipping_cost"];
                            $sold = $r["sold"];
                            $youtube_link = $r["youtube_link"];
                            $category = $r["category_id"];
                            $subcategory = $r["subcategory_id"];
                            $query3 = "SELECT * FROM categories WHERE id = '$category'";
                            $result3 = mysqli_query($this->conn, $query3);
                            $r3 = mysqli_fetch_assoc($result3);
                            $category_name = $r3["name"];
                            $query4 = "SELECT * FROM sub_categories WHERE id = '$subcategory'";
                            $result4 = mysqli_query($this->conn, $query4);
                            $r4 = mysqli_fetch_assoc($result4);
                            $sub_category_name = $r4["name"];
                            $rows2 = array();
                            $query2 = "SELECT * FROM product_images WHERE product_id = '$id'";
                                $result2 = mysqli_query($this->conn, $query2);
                                while ($r2 = mysqli_fetch_assoc($result2)) {
                                if (!empty($r2["image"])) {
                                    # code...
                                    $img = $r2["image"];
                                $rows2[] = $img;
                                }
                            }
                            $data[] = array(
                                "id"=>$id,
                                "user_id"=>$user_id,
                                "title"=>$title,
                                "description"=>$description,
                                "price"=>$price,
                                "location"=>$location,
                                "location_lat"=>$location_lat,
                                "location_log"=>$location_log,
                                "product_condition"=>$product_condition,
                                "exchange"=>$exchange,
                                "fixed_price"=>$fixed_price,
                                "giveaway"=>$giveaway,
                                "shipping_cost"=>$shipping_cost,
                                "sold"=>$sold,
                                "youtube_link"=>$youtube_link,
                                "created_at"=>$created_at,
                                "category"=>array(
                                    "category_id"=>$category,
                                    "category_name"=>$category_name,
                                ),
                                "subcategory"=>array(
                                    "sub_category_id"=>$subcategory,
                                    "sub_category_name"=>$sub_category_name,
            
                                ),
                                "image"=>$rows2
                            );
                            
                            
                        }
                    }
                    # code...
            
            }
            return $data;
        }
        return array();
    }
}
