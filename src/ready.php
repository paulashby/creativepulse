<?php
namespace ProcessWire;

if (!defined("PROCESSWIRE"))
    die();

    $this->addHookBefore('Pages::saveReady', function (HookEvent $event) {
    
        // Write custom styles to file
        $page = $event->arguments(0);

        if ($page->template->name !== "project") {
            return;
        }
    
        $custom_styles = "";
        $styles_out = "";
        $page_styles = $page->custom_styles;

        if ($page_styles) {
            $styles_out .= ".{$page->name} main {\n\t" .
            str_replace("\n", "\n\t", $page_styles) .
            "\n}\n";
        }
        
        $components = $page->project_component;        
    
        foreach ($components as $component) {
            $id = $component->id;

            $component_bg_color = $component->getFormatted('bg_color');
            $custom_color = $component_bg_color && $component_bg_color !== "#ffffff";
            $custom_styles = $component->custom_styles;

            if ($custom_color || $custom_styles) {
                $styles_out .= "#component_$id.component {\n";

                if ($custom_color) {
                    $styles_out .= "\tbackground-color: $component_bg_color;";
                }

                if ($custom_styles) {
                    $styles_out .= "\n\t" .
                    str_replace("\n", "\n\t", $custom_styles);
                }
                $styles_out .= "\n}\n";
            }

        }

        $templates_dir = $this->config->paths->templates;
        $project_name = $page->name;
        $file_name = $templates_dir . "css/custom/{$project_name}.css";
        $int = $this->files->filePutContents($file_name, $styles_out);

        if (!$int) {
            $this->warning("There was a problem writing custom styles to file");
        } 

    });