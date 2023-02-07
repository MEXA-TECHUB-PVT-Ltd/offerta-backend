<?php
class Categories{
    public $id;
    public $sub_id;
    public $cat_id;
    public $subcategory_id;
    public $attributes_id;
    public $name;
    public $value;
    public $image;
    public $imageurl;
    public $conn;
    public $created_at;
    public $categories;
    public $sub_categories;
    public $attributes;
    public $sub_attributes;
    public function __construct($db){
        $this->conn = $db;
        $this->categories = "categories";
        $this->sub_categories = "sub_categories";
        $this->attributes = "attributes";
        $this->sub_attributes = "sub_attributes";
        $this->created_at = date("Y-m-d h:i");
    }
// Categories CRUD
    public function createCategories(){
        $query = "INSERT INTO ".$this->categories." (name,image,image_url,created_at) VALUES ('$this->name','$this->image','$this->imageurl','$this->created_at')";
        $insert = mysqli_query($this->conn, $query);
        if($insert){
            return true;
        }
        return false;
    }
    public function updateCategories(){
        $query = "UPDATE ".$this->categories." SET
        name = '$this->name'
        WHERE id = '$this->id'";

    $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }
        return false;
    }
    public function deleteCategories(){
        $delete = "SELECT * FROM ".$this->categories." WHERE id =".$this->id." ";
        $deleteresult = mysqli_query($this->conn, $delete);
        if (mysqli_num_rows($deleteresult) == 1) {
        $query = "DELETE FROM ".$this->categories." WHERE id =" . $this->id;
        $upload = mysqli_query($this->conn, $query);
        $query2 = "DELETE FROM ".$this->sub_categories." WHERE category_id =" . $this->id;
        $upload2 = mysqli_query($this->conn, $query2);
        $query4 = "DELETE FROM listing WHERE category_id =" . $this->id;
        $upload4 = mysqli_query($this->conn, $query4);
        if($upload && $upload2 && $upload4){
            return true;
        }}
        return false;
    }
    public function selectAllCat(){
        $query = "SELECT * FROM ".$this->categories." ";
        $result = mysqli_query($this->conn, $query);

        if ($result) {
            $rows = array();
            while ($r = mysqli_fetch_assoc($result)) {
                    $rows[] = $r;
                
            }
            return $rows;
        }

    return array();
    }
    public function selectAllCatById(){
        $query = "SELECT * FROM ".$this->categories." WHERE id='$this->id'";
        $result = mysqli_query($this->conn, $query);

    if ($result) {
        $rows = array();
        while ($r = mysqli_fetch_assoc($result)) {
                $rows[] = $r;
            
        }
        return $rows;
    }

    return array();
    }

// Sub categories CRUD
    public function createSubCategories(){
        $query = "INSERT INTO ".$this->sub_categories." (name,category_id,created_at) VALUES ('$this->name','$this->id','$this->created_at')";
        $insert = mysqli_query($this->conn, $query);
        if($insert){
            return true;
        }
        return false;
    }
    public function updateSubCategories(){
        $query = "UPDATE ".$this->sub_categories." SET
        name = '$this->name',
        category_id = '$this->cat_id'
        WHERE id = '$this->id'";

    $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }
        return false;
    }
    public function deleteSubCategories(){
        $delete = "SELECT * FROM ".$this->sub_categories." WHERE id =".$this->id." ";
        $deleteresult = mysqli_query($this->conn, $delete);
        if (mysqli_num_rows($deleteresult) == 1) {
        $query = "DELETE FROM ".$this->sub_categories." WHERE id =" . $this->id;
        $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }}
        return false;
    }
    public function selectAllSubCat(){
        $query = "SELECT * FROM ".$this->sub_categories." WHERE category_id='$this->id'";
        $result = mysqli_query($this->conn, $query);

    if ($result) {
        $rows = array();
        while ($r = mysqli_fetch_assoc($result)) {
                $rows[] = $r;
            
        }
        return $rows;
    }

    return array();
    }
    public function selectSubCatById(){
        $query = "SELECT * FROM ".$this->sub_categories." WHERE id='$this->id'";
        $result = mysqli_query($this->conn, $query);

    if ($result) {
       $rows = array();
        while ($r = mysqli_fetch_assoc($result)) {
                $rows[] = $r;
            
        }
        return $rows;
    }

    return array();
    }
    public function selectAllSubCategory(){
        $query = "SELECT * FROM sub_categories";
        
        $result = mysqli_query($this->conn, $query);

        if ($result) {
            $rows = array();
            while ($r = mysqli_fetch_assoc($result)) {
                    $rows[] = $r;
                
            }
            return $rows;
        }

    return array();
    }
    // Attribute CRUD
    public function createAttributes(){
        $query = "INSERT INTO ".$this->attributes." (name,subcategory_id,value,created_at) VALUES ('$this->name','$this->id','$this->value','$this->created_at')";
        $insert = mysqli_query($this->conn, $query);
        if($insert){
            return true;
        }
        return false;
    }
    public function updateAttributes(){
        $query = "UPDATE ".$this->attributes." SET
        name = '$this->name',
        subcategory_id = '$this->subcategory_id',
        value = '$this->value'
        WHERE id = '$this->id'";

    $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }
        return false;
    }
    public function deleteAttributes(){
        $delete = "SELECT * FROM ".$this->sub_categories." WHERE id =".$this->id." ";
        $deleteresult = mysqli_query($this->conn, $delete);
        if (mysqli_num_rows($deleteresult) == 1) {
        $query = "DELETE FROM ".$this->attributes." WHERE id =" . $this->id;
        $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }}
        return false;
    }
    public function selectAttributeById(){
        $query = "SELECT * FROM ".$this->attributes." WHERE id='$this->id'";
        $result = mysqli_query($this->conn, $query);

        if ($result) {
            $rows = array();
            while ($r = mysqli_fetch_assoc($result)) {
                    $rows[] = $r;
                
            }
            return $rows;
        }

    return array();
    }
    public function selectAllAttribute(){
        $query = "SELECT * FROM ".$this->attributes." ";
        $result = mysqli_query($this->conn, $query);

    if ($result) {
        $rows = array();
        while ($r = mysqli_fetch_assoc($result)) {
                $rows[] = $r;
            
        }
        return $rows;
    }

    return array();
    }
    // Sub Attribute CRUD

    public function createSubAttributes(){
        $query = "INSERT INTO ".$this->sub_attributes." (name,attributes_id,value,created_at) VALUES ('$this->name','$this->attributes_id','$this->value','$this->created_at')";
        $insert = mysqli_query($this->conn, $query);
        if($insert){
            return true;
        }
        return false;
    }
    public function updateSubAttributes(){
        $query = "UPDATE ".$this->sub_attributes." SET
        name = '$this->name',
        attributes_id = '$this->attributes_id',
        value = '$this->value'
        WHERE id = '$this->id'";

    $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }
        return false;
    }
    public function deleteSubAttributes(){
        $delete = "SELECT * FROM ".$this->sub_attributes." WHERE id =".$this->id." ";
        $deleteresult = mysqli_query($this->conn, $delete);
        if (mysqli_num_rows($deleteresult) == 1) {
        $query = "DELETE FROM ".$this->sub_attributes." WHERE id =" . $this->id;
        $upload = mysqli_query($this->conn, $query);
        if($upload){
            return true;
        }}
        return false;
    }
    public function selectSubAttributeById(){
        $query = "SELECT * FROM ".$this->sub_attributes." WHERE id='$this->id'";
        $result = mysqli_query($this->conn, $query);

        if ($result) {
            $rows = array();
            while ($r = mysqli_fetch_assoc($result)) {
                    $rows[] = $r;
                
            }
            return $rows;
        }

    return array();
    }
    public function selectAllSubAttribute(){
        $query = "SELECT * FROM ".$this->sub_attributes." ";
        $result = mysqli_query($this->conn, $query);

    if ($result) {
        $rows = array();
        while ($r = mysqli_fetch_assoc($result)) {
                $rows[] = $r;
            
        }
        return $rows;
    }

    return array();
    }
}