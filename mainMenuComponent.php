<?php
class mainMenuComponent{

    public function mainMenu($itemName,$id,$link){
        $element="
        <div class=\"mainMenu col-6 col-sm-4 col-md-3 clickable\" onclick=window.location.href=\"itemsList.php?name=$id\" style=\" padding:10px;\">
                <form action=\"\" method=\"post\">
                    <div class=\"card shadow\">
                        <div >
                            <img src=\"images/$id.jpg\" alt=\"$itemName.jpg\" class=\"img-category\">
                        </div>
                        <div class=\"card-body\">
                            <h5 class=\"card-title\"> $itemName</h5>

                        </div>     
                    </div>
                </form> 
            </div>
        ";
        echo $element;
    }

    function listItemComponent($name,$price,$id){
        $element="<form method=\"POST\" action=\"\">
                    <div class=\"list-group-item\">
                        <h4 id=\"item-name\">$name</h4>
                        <h4 id=\"item-price\">$price</h4>
                        <div id=\"item-qty\">
                                
                                <input type=\"number\" style=\"width:50px;\" name=\"quantity\" id=\"qty\" value=\"1\">    
                               
                        </div>
                        <button id=\"btn-addCart\" name=\"add\" value=\"addCart\">Add to Cart</button>
                        <div style=\"clear:both\">
                                <input type=\"hidden\" name=\"itemID\" value=\"$id\">
                                <input type=\"hidden\" name=\"itemName\" value=\"$name\">
                        </div>
                            
                    </div>
                </form>
                ";
    echo $element;
    }

    function cartItemComponent($name,$price,$id,$qty,$itemNum){
        $element="
        <form method=\"POST\" action=\"\">
        <div class=\"list-group-item\" >
            <h4 id=\"item-name\">$name</h4>
            <h4 id=\"item-price\">$price</h4>
            <h4 id=\"item-qty\">$qty</h4>
            <button id=\"btn-removeItem\" name=\"remove\">Remove</button>
            <div style=\"clear:both\">
                <input type=\"hidden\" name=\"itemID\" value=\"$id\">
                <input type=\"hidden\" name=\"itemNum\" value=\"$itemNum\">
            </div>
        </div>
    </form>
        ";
        echo $element;
    }

    function orderItemComponent($name,$id,$qty,$status){
        $element="
        <form method=\"POST\" action=\"\">
        <div class=\"list-group-item\">
            <h4 id=\"item-name\">$name</h4>
            <h4 id=\"item-qty\">$qty</h4>
            <h4 id=\"item-status\">$status...</h4>
            <div style=\"clear:both\"></div>
            <input type=\"hidden\" name=\"itemID\" value=\"$id\">
        </div>
    </form>
        ";
        echo $element;
    }

    function cheffOrdersItemComponent($name,$id,$qty,$table){
        $element="
        <form method=\"POST\" action=\"\">
        <div class=\"list-group-item\">
            <h4 id=\"item-name\">$name</h4>
            <h4 id=\"item-qty\">$qty</h4>
            <h4 id=\"item-tableNum\">$table</h4>
            <button id=\"btn-addCart\" name=\"start\" value=\"\">Start Preparing</button>
            <button id=\"btn-addCart\" name=\"ready\" value=\"\">Ready to serve</button>
            <div style=\"clear:both\"></div>
            <input type=\"hidden\" name=\"itemID\" value=\"$id\">
            <input type=\"hidden\" name=\"tableNum\" value=\"$table\">
        </div>
    </form>
        ";
        echo $element;
    }

    function checkOutItemComponent($name,$id,$qty,$price){

        $total=$qty*$price;
        $element="
        <form method=\"POST\" action=\"\">
        <div class=\"list-group-item\" >
            <h4 id=\"item-name\">$name</h4>
            <h4 id=\"item-price\">$price</h4>
            <h4 id=\"item-qty\">$qty</h4>
            <h4 id=\"item-qty\">$total</h4>
            <div style=\"clear:both\"></div>
            
        </div>
    </form>
        ";
        echo $element;
    }
    
    
    function waiterOrdersItemComponent($name,$id,$qty,$table){
        $element="
        <form method=\"POST\" action=\"\">
        <div class=\"list-group-item\">
            <h4 id=\"item-name\">$name</h4>
            <h4 id=\"item-qty\">$qty</h4>
            <h4 id=\"item-tableNum\">$table</h4>
            <button id=\"btn-addCart\" name=\"served\" value=\"\">served</button>
            <div style=\"clear:both\"></div>
            <input type=\"hidden\" name=\"itemID\" value=\"$id\">
            <input type=\"hidden\" name=\"tableNum\" value=\"$table\">
        </div>
    </form>
        ";
        echo $element;
    }
    

    function parkingSlots($parkingNum,$vehicleNum,$status){
        if($status==="Reserved"){
            $color="rgba(252,0, 0, 0.5)";
        }else IF($status==="Bill Paid"){
            $color="rgba(0, 252, 0, 0.5)";
        }else{
            $color="";
        }
        
        $element="
        <div class=\"col-md-3 text-center p-5 \">
          <div class=\"border rounded-lg\">
          <form method=\"post\" action=\"\">
              <div class=\"card\" style=\"height:200px;background-color:$color;\">
                  <div class=\"card-body\">
                      <h5 class=\"card-title\">$parkingNum</h5>
                      <h5 class=\"card-subtitle mb-2 text-muted\">$vehicleNum</h5>
                      <h5 class=\"card-subtitle mb-2 text-muted\">$status</h5>
                      <input type=\"hidden\" name=\"status\" value=\"$status\">
                      <input type=\"hidden\" name=\"parkingNum\" value=\"$parkingNum\">
                      
                  </div>
              </div>
              <button type=\"submit\" value=\"submit\" name=\"parkingClear\" class=\"btn btn-dark m-3\">Clear Parking</button>
              </form>
          </div>
      </div>
        ";
        echo $element;
    }
    


    function todayTransactionList($txnID,$txnDate,$amount,$status){
        $element="
        <tr>
              <td>$txnID</td>
              <td>$txnDate</td>
              <td>$amount</td>
              <td>$status</td>
            </tr>
        ";
        echo $element;
    }
    



}

?>


