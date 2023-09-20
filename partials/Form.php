<?php 
    /**
     * Cette classe gère tous les composants réutilisable d'un formulaire
     * @method string input_field() Permet d'afficher un champ input
     * @method string select_field() Permet d'afficher un champ select
     * @method string textarea_field() Permet d'afficher un champ textarea
     */
    class Form{
        /**
         * Permet de retourner un champ input
         * @param string $type le type du champ
         * @param string $name Le nom du champ
         * @param string $label Le label du champ
         * @param int $min Le minimum accepté
         * @param int $max Le maximum accepté
         * @param bool $required Pour obliger un champ, par défaut à true
         * @return string $inputField
         */
        public function input_field($type, $name, $label, $min=0, $max=1000000, $required=true, $valueDefined=""): string{
            $requiredText = "required";
            if(!$required){
                $requiredText = "";
            }
            $value = $_POST[''.$name]??$valueDefined;
            $minValeur = ($type=='number')?$min:'';
            $maxValeur = ($type=='number' || $type=='date')?$max:'';
            return <<<HTML
                <div class="col-12 my-1">
                    <label for="$name" class="form-label">$label</label>
                    <input type="$type" class="form-control" id="$name" name="$name" $requiredText min="$minValeur" $max="$maxValeur" value="$value">
                </div>
HTML;
        }
        /**
         * Permet de retourner un champ select
         * @param string $name Le nom du champ
         * @param array $options La liste des options associées
         * @param string $label Le label visible dans le champ.
         * @return string $heredoc La structure html formatée
         */
        public function select_field($name, array $options, $label){
            $selected = $_POST[''.$name]??"";
        $heredoc = <<<HTML
            <div class="col-12 my-1">
                <select name="$name" id="$name" class="form-select"  required>
                    <option value=""></option>
HTML;
                    foreach($options as $key=>$option){
                        if($selected == $key){
                            $heredoc .= "<option value='$key' selected>$option</option>";
                        }else{
                            $heredoc .= "<option value='$key'>$option</option>";
                        }
                        
                    }
                    $heredoc .= <<<HTML
                </select>
                <label for="$name">$label</label>
            </div>
HTML;
        return $heredoc;

        }

        /**
         * Permet de créer un champ textarea du formulaire  bootstrap
         * @param string $name Le nom de la variable que la logique utilisera
         * @param string $label Le label visible dans le champ.
         * @return string $heredoc La structure html formatée
         */
        public static function textarea_field($name, $label, $required = true){
            $requiredText = "required";
            if(!$required){
                $requiredText = "";
            }
            $value = $_POST[''.$name]??'';
            return <<<HTML
                <div class="form-floating my-2">
                    <textarea class="form-control" id="$name"  name="$name" $requiredText>$value</textarea>                
                    <label for="$name">$label</label>
                </div>
HTML;
        }
    }
?>
