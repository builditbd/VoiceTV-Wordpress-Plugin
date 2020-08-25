<?php
    $districts = ["Bagerhat", "Bandarban"," Sirajganj", "Barguna", "Sylhet", "Barishal", "Bhola", "Bogura", "Brahmanbaria", "Chandpur", "Chapainawabganj", "Chattogram", "Chuadanga", "Coxsbazar", "Cumilla", "Dhaka", "Dinajpur", "Faridpur", "Panchagarh", "Feni", "Gaibandha", "Gazipur", "Gopalganj", "Habiganj", "Jamalpur", "Jhenaidah", "Jhalakathi", "Joypurhat", "Khagrachhari", "Khulna", "Kishoreganj", "Kurigram", "Sherpur", "Kushtia", "Lakshmipur", "Lalmonirhat", "Madaripur", "Magura", "Manikganj", "Meherpur", "Moulvibazar", "Munshiganj", "Mymensingh", "Naogaon", "Jashore", "Narail", "Narayanganj", "Natore", "Netrokona", "Nilphamari", "Noakhali", "Pabna", "Patuakhali", "Pirojpur", "Rajbari", "Rajshahi", "Rangamati", "Rangpur", "Satkhira", "Shariatpur", "Sunamganj", "Narsingdi", "Tangail", "Thakurgaon"];
    $voice_column = esc_attr( get_post_meta( get_the_ID(), 'voice_column', true ) );
    $is_featured = esc_attr( get_post_meta( get_the_ID(), 'is_featured', true ) );
?>

<div class="district_box">
    <style scoped>
        .district_box .description {
            box-shadow: 0 0 3px slategrey;
            padding: 10px;
        }
        .d-block {display:  block;}
        .float-left {float: left;}
        .float-right {float: right;}
        .text-center {text-aligh: center;}
        .width50 {width: 50%;}
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
    
    <div class="description" style="background-color: aquamarine;">
        <label for="is_featured">Feature this post on homepage <?= $is_featured ?></label>
        <input id="is_featured" name="is_featured" type="checkbox" value="true" <?= checked( $is_featured, 'true' ) ?>/>
    </div>
    <div class="description" style="background-color: azure">
        <p>Feature in Voice Column?</p>
        <div class="d-block clearfix width50">
            <div class="text-center float-left">
                <input type="radio" id="voice_column_yes" name="voice_column" value="yes" <?= ($voice_column == 'yes' ) ? "checked":"";?>>
                <label for="voice_column_yes">Yes</label>
            </div>
            <div class="text-center float-right width50">
                <input type="radio" id="voice_column_no" name="voice_column" value="" <?= ( $voice_column !== 'yes' ) ? "checked":"";?>>
                <label for="voice_column_no">No</label>
            </div>
        </div>
    </div>
    <div class="description meta-options hcf_field" style="background-color: beige">
        <label for="district">Select a district</label>
        <select id="district" class="form-control" name="district" aria-required="true" aria-invalid="true" style="width: 100%;">
            <option value="">Select District</option>
            <?php foreach ($districts as $d): ?>
                <option value="<?=$d ?>" <?= (esc_attr( get_post_meta( get_the_ID(), 'district', true ) ) == $d ) ? "selected":"";?>><?=$d ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>