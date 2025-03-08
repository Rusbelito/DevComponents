<?php

namespace Rusbelito\DevComponents\Providers;

use Illuminate\View\Compilers\ComponentTagCompiler;

class DevTagCompiler extends ComponentTagCompiler
{
    public function compile(string $value)
    {

        $value = $this->compileDynamicTags($value);
        $value = $this->compileOpeningTags($value);
        $value = $this->compileSelfClosingTags($value);
        $value = $this->compileClosingTags($value);

        return $value;
    }

    protected function compileDynamicTags(string $value)
    {
        // $text = '...<rusbelito:dynamic :component="\'alert\'" />...';

        $pattern = '/<rusbelito:dynamic\s*([^>]*)>/';

        $texto_editado = preg_replace_callback($pattern, function ($matches) {

            $comPattern = '/:component="\'\s*([^"]*)\'"/';

            if (preg_match($comPattern, $matches['1'], $ResultName)) {

                $name = $ResultName[1];

                $nameSpacer = preg_replace($comPattern, '', $matches['1']);





                $patron = '/\s+/';

                $complement = preg_replace($patron, ' ', $nameSpacer);


                return '<rusbelito:' . $ResultName[1] . ' ' . $complement . '>';
            }
        }, $value);

        // dd($texto_editado);

        return $texto_editado;
    }


    // $result = preg_replace_callback($pattern, function ($matches) {
    //     // El valor de :component está en $matches[1] o $matches[2]

    //     dd($matches['attributes']);

    //     $this->boundAttributes = [];
    //     $attributes = $this->getAttributesFromAttributeString($matches['attributes']);

    //     $component = $matches[1] ?? $matches[2];
    //     dd($attributes);
    //     return  $this->componentString('rusbelito::' . $component, $attributes);
    // }, $value);
    // dd($result);



    //         $hola =  preg_replace_callback($pattern, function (array $matches) {

    //             $this->boundAttributes = [];
    //             $attributes = $this->getAttributesFromAttributeString($matches['attributes']);
    //             dd($matches);
    //             // Extraer el nombre del componente dinámico
    //             $component = $attributes['component'] ?? '';
    //             unset($attributes['component']);

    //             // Generar la llamada al componente dinámico
    //             return "@component('{$component}', " . json_encode($attributes) . ")";
    //         }, $value);
    //    dd( $hola );
    //         return $hola ; 


    protected function compileOpeningTags(string $value)
    {

        $pattern = "/
            <
                \s*
                rusbelito[\:]([\w\-\:\.]*)
                (?<attributes>
                    (?:
                        \s+
                        (?:
                            (?:
                                @(?:class)(\( (?: (?>[^()]+) | (?-1) )* \))
                            )
                            |
                            (?:
                                @(?:style)(\( (?: (?>[^()]+) | (?-1) )* \))
                            )
                            |
                            (?:
                                \{\{\s*\\\$attributes(?:[^}]+?)?\s*\}\}
                            )
                            |
                            (?:
                                (\:\\\$)(\w+)
                            )
                            |
                            (?:
                                [\w\-:.@%]+
                                (
                                    =
                                    (?:
                                        \\\"[^\\\"]*\\\"
                                        |
                                        \'[^\']*\'
                                        |
                                        [^\'\\\"=<>]+
                                    )
                                )?
                            )
                        )
                    )*
                    \s*
                )
                (?<![\/=\-])
            >
        /x";



        $hola = preg_replace_callback($pattern, function (array $matches) {
            $this->boundAttributes = [];

            $attributes = $this->getAttributesFromAttributeString($matches['attributes']);

            if (strpos($this->aliases[$matches[1]], '\\') !== false) {
                return "@component('" . $this->aliases[$matches[1]] . "', " . json_encode($attributes) . ")";
            } else {
                return $this->componentString('rusbelito::' . $matches[1], $attributes);
            }
        }, $value);



        return $hola;
    }

    protected function compileSelfClosingTags(string $value)
    {
        $pattern = "/
            <
                \s*
                rusbelito[\:]([\w\-\:\.]*)
                \s*
                (?<attributes>
                    (?:
                        \s+
                        (?:
                            (?:
                                @(?:class)(\( (?: (?>[^()]+) | (?-1) )* \))
                            )
                            |
                            (?:
                                @(?:style)(\( (?: (?>[^()]+) | (?-1) )* \))
                            )
                            |
                            (?:
                                \{\{\s*\\\$attributes(?:[^}]+?)?\s*\}\}
                            )
                            |
                            (?:
                                (\:\\\$)(\w+)
                            )
                            |
                            (?:
                                [\w\-:.@%]+
                                (
                                    =
                                    (?:
                                        \\\"[^\\\"]*\\\"
                                        |
                                        \'[^\']*\'
                                        |
                                        [^\'\\\"=<>]+
                                    )
                                )?
                            )
                        )
                    )*
                    \s*
                )
            \/>
        /x";

        return preg_replace_callback($pattern, function (array $matches) {
            $this->boundAttributes = [];

            $attributes = $this->getAttributesFromAttributeString($matches['attributes']);

            if (isset($attributes['slot'])) {
                $slot = $attributes['slot'];
                unset($attributes['slot']);
                return '@slot(' . $slot . ') ' . $this->componentString('rusbelito::' . $matches[1], $attributes) . "\n@endComponentClass##END-COMPONENT-CLASS##" . ' @endslot';
            }

            if (strpos($this->aliases[$matches[1]], '\\') !== false) {
                return "@component('" . $this->aliases[$matches[1]] . "', " . json_encode($attributes) . ")" . "\n@endComponentClass##END-COMPONENT-CLASS##";
            } else {
                return $this->componentString('rusbelito::' . $matches[1], $attributes) . "\n@endComponentClass##END-COMPONENT-CLASS##";
            }
        }, $value);


        return $hola;
    }

    protected function compileClosingTags(string $value)
    {

        $lolo = preg_replace("/<\/rusbelito[\:]\s*([^>]*)>/", ' @endComponentClass##END-COMPONENT-CLASS##', $value);

        return $lolo;
    }

    public function getClassComponentAliases()
    {
        return $this->aliases;
    }

    public function renameAliases(string $oldName)
    {
        unset($this->aliases[$oldName]);
    }
}
