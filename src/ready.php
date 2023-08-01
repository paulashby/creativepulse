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
    
        $components = $page->project_component;
        $custom_styles = "";        
        
    
        foreach ($components as $component) {
            $id = $component->id;
            $component_styles = $component->custom_styles;
            
            if ($component_styles) {
                foreach ($component_styles as $media_query) {

                    $entry = [
                        "start_query_block" => "",
                        "styles" => "",
                        "end_query_block" => ""
                    ];
                        
                    // Media query feature is eg 'min-width'
                    $mq_feature = $media_query->media_query_feature_type->name;

                    if ($mq_feature !== "base") {
                        // Not base styles, so need to be wrapped in a media query
                        $mq_width = $media_query->media_query_width;
                        $entry["start_query_block"] = "\n@media screen and ($mq_feature: {$mq_width}px) {\n";
                        $entry["end_query_block"] = "}\n";
                    }

                    if ($media_query->styles) {
                        foreach ($media_query->styles as $style) {
                            $selector = $style->selector;
                            $rules = $style->rules;
    
                            $entry["styles"] .= "#component_$id $selector {
                                $rules
                            }\n";
                        }
                    }
                    $custom_styles .= implode("", $entry);
                }
            }
        }

        $templates_dir = $this->config->paths->templates;
        $project_name = $page->name;
        $file_name = $templates_dir . "css/custom/{$project_name}.css";
        $int = $this->files->filePutContents($file_name, $custom_styles);

        if (!$int) {
            $this->warning("There was a problem writing custom styles to file");
        } else {
            $this->message("Custom styles written to file");
        } 

    });
