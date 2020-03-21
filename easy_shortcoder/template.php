<div class="wrap">
            <h1 class="wp-heading-inline"> Easy shortcoder </h1>
            <h4 class="wp-heading-inline"> HOW TO? </h4>
            <h5 class="wp-heading-inline"> 1. stwórz interesujący CIę shortcode </h5>
            <h5 class="wp-heading-inline"> 2. w dowolnym miejscu w poście wstaw shortcode wg wzorca: [esc name="{zadeklarowana nazwa shortcode}"] </h5>

        </div>
        <div class="wrap">
            <form  method="post" action="<?= site_url()."/wp-admin/admin.php?page=easy_shortcoder_main".$link ?>">
                <label for="shortcoder_name"> shortcode: </label>
                <br>
                <input type="text" id="shortcoder_name" name="shortcoder_name" placeholder="nazwa" value="<?= ($name? $name : "") ?>">
                <br>
                <textarea rows="4" cols="70" id="shortcoder_txt"  name="shortcoder_txt"  placeholder="Wpisz tekst shortcorde"><?= ($txt? $txt : "") ?></textarea>
                <br>
                <input type="submit" class="button-primary" value="Zapisz">
            </form> 
        </div>
        <div class="wrap">
            <table class="widefat">
            <thead>
                <tr>
                    <th>shortcode nazwa</th> 
                    <th>shortcode text</th> 
                </tr>
            </thead>
            <tbody>
            <?php	
                    global $wpdb;
                    $tab_name = $wpdb->prefix . "easy_shortcoder";
                    $sql = "SELECT `ID`, `shortcoder_name`, `shortcoder_txt` FROM `$tab_name`";

                    foreach($wpdb->get_results($sql) as $key=>$value){
                        echo "</tr>
                                <th class=\"esc_name\"> " .$value->shortcoder_name . " </th> 
                                <th class=\"esc_txt\"> " .$value->shortcoder_txt . " </th> 
                                <th class=\"esc_buttons\"> 
                                    <a href =\"".site_url()."/wp-admin/admin.php?page=easy_shortcoder_main&editID=".$value->ID."\" class=\"button-edit\">Edytuj</a>
                                    <a href =\"".site_url()."/wp-admin/admin.php?page=easy_shortcoder_main&deleteID=".$value->ID."\" class=\"button-delete\">Usuń</a>
                                </th> 
                            </tr>
                        ";
                    }
            ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>shortcode nazwa</th> 
                    <th>shortcode text</th> 
                </tr>
            </tfoot>
            </table>
        </div>
        <style>
        .button-edit {
            padding: 5px;
            background: #008500;
            border-color: #007300;
            box-shadow: 0 1px 0 #007300;
            color: #fff;
            text-decoration: none;
            text-shadow: 0 -1px 1px #007300, 1px 0 1px #007300, 0 1px 1px #007300, -1px 0 1px #007300;
        }
        .button-edit:hover {
            background: #00ff00;
            border-color: #005000;
            color: #fff;
        }
        .button-delete {
            padding: 5px;
            background: #850000;
            border-color: #730000;
            box-shadow: 0 1px 0 #730000;
            color: #fff;
            text-decoration: none;
            text-shadow: 0 -1px 1px #730000, 1px 0 1px #730000, 0 1px 1px #730000, -1px 0 1px #730000;
        }
        .button-delete:hover {
            background: #ff0000;
            border-color: #500000;
            color: #fff;
        }
        .esc_name {
            width: 20%;
        }
        .esc_buttons {
            width: 100px;
        }
        </style>
        