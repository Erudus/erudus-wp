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

    <?php if(isset($component->component_name)): ?>
    <h2><?php echo $component->component_name; ?></h2>
    <?php endif; ?>

    <p>Weight/Volume : <?php echo $component->inner->weightvol_on_inner; ?></p>
    <p>Inner GTIN : <?php echo $component->internal_gtin; ?></p>
    <p>Packaging Type : <?php echo $component->inner->inner_packaging_type; ?></p>
    <h3>Ingredients</h3>
    <p><?php echo esc_html($component->ingredients); ?></p>

    <h3>Nutrition</h3>

    <table class="table">
        <thead>
        <tr>
            <th>Typical Values</th>
            <th style="width:20%;">Per 100g</th>
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

    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th style="width:20%;"></th>
            </tr>
        </thead>
        <tr>
            <td>Contains Cereal</td>
            <td><?php echo $component->allergens->contains_cereal; ?></td>
        </tr>
        <tr>
            <td>Contains Gluten</td>
            <td><?php echo $component->allergens->contains_gluten; ?></td>
        </tr>
        <tr>
            <td>Contains Milk</td>
            <td><?php echo $component->allergens->contains_milk; ?></td>
        </tr>
        <tr>
            <td>Contains Eggs</td>
            <td><?php echo $component->allergens->contains_eggs; ?></td>
        </tr>
        <tr>
            <td>Contains Peanuts</td>
            <td><?php echo $component->allergens->contains_peanuts; ?></td>
        </tr>
        <tr>
            <td>Contains Nuts</td>
            <td><?php echo $component->allergens->contains_tree_nuts; ?></td>
        </tr>
        <tr>
            <td>Contains Crustaceans</td>
            <td><?php echo $component->allergens->contains_crustacea; ?></td>
        </tr>
        <tr>
            <td>Contains Mustard</td>
            <td><?php echo $component->allergens->contains_mustard; ?></td>
        </tr>
        <tr>
            <td>Contains Fish</td>
            <td><?php echo $component->allergens->contains_fish; ?></td>
        </tr>
        <tr>
            <td>Contains Lupin</td>
            <td><?php echo $component->allergens->contains_lupin; ?></td>
        </tr>
        <tr>
            <td>Contains Sesame</td>
            <td><?php echo $component->allergens->contains_sesame_seeds; ?></td>
        </tr>
        <tr>
            <td>Contains Celery</td>
            <td><?php echo $component->allergens->contains_celery_celeriac; ?></td>
        </tr>
        <tr>
            <td>Contains Soya</td>
            <td><?php echo $component->allergens->contains_soybeans; ?></td>
        </tr>
        <tr>
            <td>Contains Molluscs</td>
            <td><?php echo $component->allergens->contains_molluscs; ?></td>
        </tr>
        <tr>
            <td>Contains Sulphur Dioxide</td>
            <td><?php echo $component->allergens->contains_sulphur_dioxide; ?></td>
        </tr>
    </table>

    <h3>Dietary Information</h3>

    <table class="table">
        <thead>
        <tr>
            <th></th>
            <th style="width:20%;"></th>
        </tr>
        </thead>
        <tr>
            <td>Suitable for Vegetarians</td>
            <td><?php echo $component->diets->vegetarian_suitable; ?></td>
        </tr>
        <tr>
            <td>Suitabel for Vegans</td>
            <td><?php echo $component->diets->vegan_suitable; ?></td>
        </tr>
        <tr>
            <td>Suitable for Sufferers of Lactose Intolerance</td>
            <td><?php echo $component->diets->lactose_intolerance_suitable; ?></td>
        </tr>
        <tr>
            <td>Suitable for Coeliacs</td>
            <td><?php echo $component->diets->coeliacs_suitable; ?></td>
        </tr>
        <tr>
            <td>Approved for a Halal Diet</td>
            <td><?php echo $component->diets->halal_approved; ?></td>
        </tr>
        <tr>
            <td>Approved for a Kosher Diet</td>
            <td><?php echo $component->diets->kosher_approved; ?></td>
        </tr>

    </table>

    <h3>Handling & Preparation</h3>
    <h4>Directions for Use</h4>
    <p><?php echo nl2br( $component->handling->directions_for_use); ?></p>
    <h4>Storage Instructions</h4>
    <p><?php echo nl2br($component->handling->storage_instructions); ?></p>

    <h3>Country of Origin</h3>
    <p><?php echo $component->country_of_origin->country ?> (<?php echo $component->country_of_origin->details ?>)</p>

<?php } ?>

<p><small>data supplied by <a href="https://erudus.com" title="Erudus - the Food Industry's solution for Product Data.">Erudus</a></small></p>
