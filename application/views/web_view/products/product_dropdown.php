<select type="select" name="product_id" autocomplete="off" id="produt_id" required="required" first_option=""
    class="form-control">
    <option value="">Select one...</option>
    <?php if ($sheet_model) {
        foreach ($sheet_model as $key => $value) {
            echo "<option value='" . $value->spec_sheet_dt_id . "'>" . $value->model . "</option>";
        }
    } ?>
</select>