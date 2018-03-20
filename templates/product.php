<?php
/**
 * Product template file
 * To customosie copy to theme folder/erudus/product.php
 */
?>

<h2><?php echo $product->case_label_name; ?></h2>

<p>GTIN : <?php echo $product->traded_unit_gtin; ?></p>

    <p><?php echo $product->product_description; ?></p>

<?php foreach($product->components as $component) { ?>

    <p>Weight/Volume : <?php echo $component->inner->weightvol_on_inner; ?></p>
    <p>Inner GTIN : <?php echo $component->internal_gtin; ?></p>

    <h3>Ingredients</h3>
    <p><?php echo esc_html($component->ingredients); ?></p>

    <h3>Nutrition</h3>

    <table class="table">
        <thead>
        <tr>
            <th>Typical Values</th>
            <th>Per 100g</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td>Energy</td>
                <td>
                    <?php echo $component->nutrients->cal_100_kj->value ?> <?php echo $component->nutrients->cal_100_kj->unit ?><br>
                    <?php echo $component->nutrients->cal_100_kcal->value ?> <?php echo $component->nutrients->cal_100_kcal->unit ?>
                </td>
            </tr>
            <tr>
                <td>Carbohydrates</td>
                <td>
                    <?php echo $component->nutrients->carb_100->value ?> <?php echo $component->nutrients->carb_100->unit ?>
                </td>
            </tr>
            <tr>
                <td> - of which sugars</td>
                <td>
                    <?php echo $component->nutrients->sugar_carb_100->value ?> <?php echo $component->nutrients->sugar_carb_100->unit ?>
                </td>
            </tr>
            <tr>
                <td>Fat</td>
                <td>
                    <?php echo $component->nutrients->fat_100->value ?> <?php echo $component->nutrients->fat_100->unit ?>
                </td>
            </tr>
            <tr>
                <td> - of which saturates</td>
                <td>
                    <?php echo $component->nutrients->sat_fat_100->value ?> <?php echo $component->nutrients->sat_fat_100->unit ?>
                </td>
            </tr>
            <tr>
                <td>Fibre</td>
                <td>
                    <?php echo $component->nutrients->fibre_100->value ?> <?php echo $component->nutrients->fibre_100->unit ?>
                </td>
            </tr>
            <tr>
                <td>Protein</td>
                <td>
                    <?php echo $component->nutrients->protein_100->value ?> <?php echo $component->nutrients->protein_100->unit ?>
                </td>
            </tr>
            <tr>
                <td>Salt</td>
                <td>
                    <?php echo $component->nutrients->salt_100->value ?> <?php echo $component->nutrients->salt_100->unit ?>
                </td>
            </tr>
        </tbody>
    </table>


    <h3>Allergens</h3>

    <h3>Dietary Information</h3>

    <h3>Handling & Preparation</h3>
    <p><?php echo nl2br( $component->handling->directions_for_use); ?></p>
    <p><?php echo nl2br($component->handling->storage_instructions); ?></p>
    <?php var_dump($component ) ?>
<?php } ?>