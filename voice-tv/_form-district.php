<?php
    $districts = ["Bagerhat", "Bandarban", "Barguna", "Barisal", "Bhola", "Bogra", "Brahmanbaria", "Chandpur", "Chittagong", "Chuadanga", "Comilla", "Cox's Bazar", "Dhaka", "Dinajpur", "Faridpur", "Feni", "Gaibandha", "Gazipur", "Gopalganj", "Habiganj", "Jamalpur", "Jessore", "Jhalakati", "Jhenaidah", "Joypurhat", "Khagrachari", "Khulna", "Kishorganj", "Kurigram", "Kustia", "Lalmonirhat", "Laxmipur", "Madaripur", "Magura", "Manikgonj", "Meherpur", "Moulvibazar", "Munsiganj", "Mymensingh", "Naogaon", "Narail", "Narayangonj", "Narsingdi", "Natore", "Nawabgonj", "Netrokona", "Nilphamari", "Noakhali", "Pabna", "Panchagarh", "Patuakhali", "Pirojpur", "Rajbari", "Rajshahi", "Rangamati", "Rangpur", "Satkhira", "Shariatpur", "Sherpur", "Sirajganj", "Sunamgonj", "Sylhet", "Tangail", "Thakurgaon"];
    $voice_column = esc_attr( get_post_meta( get_the_ID(), 'voice_column', true ) );
?>

<div class="district_box">
    <style scoped>
    </style>
    <p class="meta-options hcf_field">
        Select a district
        <select id="district" class="form-control" name="district" aria-required="true" aria-invalid="true">
            <option value="">Select District</option>
            <?php foreach ($districts as $d): ?>
                <option value="<?=$d ?>" <?= (esc_attr( get_post_meta( get_the_ID(), 'district', true ) ) == $d ) ? "selected":"";?>><?=$d ?></option>
            <?php endforeach; ?>
        </select>
    </p>
    <p class="description">
        <p>Feature in Voice Column?</p>
        <input type="radio" id="voice_column_yes" name="voice_column" value="yes" <?= ($voice_column == 'yes' ) ? "checked":"";?>>
        <label for="voice_column_yes">Yes</label><br>
        <input type="radio" id="voice_column_no" name="voice_column" value="" <?= ( $voice_column !== 'yes' ) ? "checked":"";?>>
        <label for="voice_column_no">No</label><br>
    </p>
</div>