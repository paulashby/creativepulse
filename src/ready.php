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

        $page_bg_color = $page->getFormatted('bg_color');
        $page_bg_color_property = $page_bg_color && $page_bg_color !== "#ffffff" ? "\tbackground-color: $page_bg_color;" : "";

        $page_styles = $page->custom_styles;

        if ($page_styles) {
            $styles_out .= "body.{$page->name} {\n$page_bg_color_property\n}\n" .
            trim($page_styles) .
            "\n";
        }
        $components = $page->project_component;        
    
        foreach ($components as $component) {
            $id = $component->id;

            $component_bg_color = $component->getFormatted('bg_color');
            $custom_color = $component_bg_color && $component_bg_color !== "#ffffff";
            $custom_styles = $component->custom_styles;

            if ($custom_color || $custom_styles) {
                $component_selector = "#component_$id.component";

                if ($custom_color) {
                    $styles_out .= "$component_selector {\n\tbackground-color: $component_bg_color;\n}\n";
                }

                if ($custom_styles) {
                    $styles_out .= str_replace("this", $component_selector, trim($custom_styles));
                }
                $styles_out .= "\n";
            }

        }

        $templates_dir = $this->config->paths->templates;
        $project_name = $page->name;
        $file_name = $templates_dir . "css/custom/{$project_name}.css";
        $int = $this->files->filePutContents($file_name, $styles_out);

        if (strlen($styles_out && !$int)) {
            $this->warning("There was a problem writing custom styles to file");
        }
    });
