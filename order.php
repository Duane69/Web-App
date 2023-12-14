<?php
function displayOrderSummary()
{
        if ($_SERVER["REQUEST_METHOD"]==="POST") {
        echo "<dic class='summary'>";
        echo "<h1> Order Summary</h1>";

        $Shirt_prices =[
        "Black" => 250.00,
        "White" => 200.00,
        "Red" => 250.00,
        "Blue" => 250.00,
        "Gray" => 250.00,
        ];

        $Size_prices = [
        "Small" => 0.00,
        "Medium" => 0.00,
        "Large" => 0.00,
        "2XL" => 0.00,
        "3XL" => 0.00,
        ];

        $Additional_prices =[
        "4XL" => 50.00,
        "5XL" => 50.00,
        ];

        $Shirt_type= $_POST["Shirt"];
        $Size = $_POST["Size"];
        $Customize_Size = $_POST["Customize_Size"];
        $Additional = isset($_POST["Additional"]) ? $_POST["Additional"] : [];
        $name = $_POST["name"];
        $Shirt_type = $_POST ["Shirt_type"];
        $total_price = calculateTotalPrice ( $Shirt_prices, $Shirt_type , $Size_prices,$Size,$Additional , $Additional_prices );
}
}
function calculateTotalPrice ( $Shirt_prices, $Shirt_type , $Size_prices,$Size , $Additional , $Additional_prices ) {
    $total_price = $Shirt_prices [$Shirt_type] + $Size_prices [$Size];

        foreach ($Additional as $extra) {
            $total_price += $Additional_prices[$extra];
        }
        return $total_price;
        }
function displayOrderDetails ($name,$Shirt_type,$Shirt_prices,$Size_prices,$Size,$Additional,$Additional_prices,$Customize_Size,$total_price){
        echo "<table>";

        echo "<tr><td>Name</td><td>" . htmlspecialchars($name) . "</td></tr>";

        echo "<tr><td>Shirt Color</td><td>" . htmlspecialchars($Shirt_type) . " (₱" . number_format($Shirt_prices[$Shirt_type], 2) . ")</td></tr>";

        echo "<tr><td>Size</td><td>" . htmlspecialchars($Shirt_prices) . " (₱" . number_format($Size_prices[$Size], 2) . ")</td></tr>";
}
        if (!empty($Additional)) {
            echo "<tr><td>Addtional:</td><td>" . implode(", ", $Additional) . " (₱" . number_format(array_sum(array_intersect_key($Additional_prices, array_flip($Additional))), 2) . ")</td></tr>";
            echo "<tr><td>Total Price</td><td>₱" . number_format($total_price, 2) . "</td></tr>";
            echo "<tr><td>Customize Size:</td><td>" . htmlspecialchars($Customize_Size) . "</td></tr>";
            echo "</table>";
        }
            if ($Shirt_type !== "Black") {
                echo "<p>Fly with QualiTee</p>";
            

            echo "</div>";

        }


        displayOrderSummary();