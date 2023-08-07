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
        $page_bg_color = $page->getFormatted('bg_color');

        if ($page_bg_color && $page_bg_color !== "#ffffff") {
            $custom_styles .= ".nav, .nav__submenu-entries {\n\tbackground-color: $page_bg_color;\n}\n@media screen and (min-width: 650px) {\n\t.project-header {\n\tbackground-color: $page_bg_color;\n\t}\n}\n";
        }
        
        $page_styles = $page->custom_styles;

        if ($page_styles) {
            $custom_styles .= getCustomStyles($page_styles, "main");
        }
        
        $components = $page->project_component;        
    
        foreach ($components as $component) {
            $id = $component->id;
            $parent_selector = "#component_$id.component";

            $component_bg_color = $component->getFormatted('bg_color');

            if ($component_bg_color && $component_bg_color !== "#ffffff") {
                $custom_styles .= "$parent_selector {\n\tbackground-color: $component_bg_color;\n}\n";
            }

            $component_styles = $component->custom_styles;
            
            if ($component_styles) {
                $custom_styles .= getCustomStyles($component_styles, $parent_selector);
            }
        }

        $custom_styles .= "\n";

        $templates_dir = $this->config->paths->templates;
        $project_name = $page->name;
        $file_name = $templates_dir . "css/custom/{$project_name}.css";
        $int = $this->files->filePutContents($file_name, $custom_styles);

        if (!$int) {
            $this->warning("There was a problem writing custom styles to file");
        } 

    });

    function getCustomStyles($custom_styles_repeater, $parent_selector) {
        $entries = "";

        foreach ($custom_styles_repeater as $media_query) {

            $entry = [
                "start_query_block" => "",
                "styles" => "",
                "end_query_block" => ""
            ];
                
            // Media query feature is eg 'min-width'
            $mq_feature = $media_query->media_query_feature_type->name;
            $tabs = "\t";
            $tabs_mq = "";

            if ($mq_feature !== "base") {
                // Not base styles, so need to be wrapped in a media query
                $mq_width = $media_query->media_query_width;
                $entry["start_query_block"] = "@media screen and ($mq_feature: {$mq_width}px) {\n";
                $entry["end_query_block"] = "}\n";
                $tabs = "\t\t";
                $tabs_mq = "\t";
            }

            if ($media_query->styles) {
                foreach ($media_query->styles as $style) {
                    $selector =  $style->selector;
                    $rules = $style->rules;
                    $rules_tabbed = $tabs . str_replace("\n", "\n$tabs", $rules);

                    $entry["styles"] .= "{$tabs_mq}$parent_selector $selector {\n$rules_tabbed\n$tabs_mq}\n";
                }
            }
            $entries .= implode("", $entry);
        }
        return $entries;
    }
