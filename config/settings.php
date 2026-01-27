<?php

declare(strict_types=1);

return [

    /****************************************
     *   THEME SETTINGS
     ****************************************/
    'theme_settings' => [
        'fields' => [
            /****************************************
             *   TYPOGRAPHY SETTINGS
             ****************************************/
            'primary-font-family' => [
                'type' => 'select',
                'name' => 'primary-font-family',
                'label' => 'Primary Font Family',
                'default' => 'Instrument Sans',
                'options' => [
                    'Instrument Sans' => 'Instrument Sans',
                    'Inter' => 'Inter',
                    'Roboto' => 'Roboto',
                    'Open Sans' => 'Open Sans',
                    'Poppins' => 'Poppins',
                    'Lato' => 'Lato',
                    'Montserrat' => 'Montserrat',
                    'Nunito' => 'Nunito',
                ],
            ],
            
            'secondary-font-family' => [
                'type' => 'select',
                'name' => 'secondary-font-family',
                'label' => 'Secondary Font Family',
                'default' => 'ui-serif',
                'options' => [
                    'ui-serif' => 'System Serif',
                    'Georgia' => 'Georgia',
                    'Times New Roman' => 'Times New Roman',
                    'Playfair Display' => 'Playfair Display',
                    'Merriweather' => 'Merriweather',
                ],
            ],
            
            'base-font-size' => [
                'type' => 'select',
                'name' => 'base-font-size',
                'label' => 'Base Font Size',
                'default' => '16px',
                'options' => [
                    '14px' => '14px (Small)',
                    '15px' => '15px',
                    '16px' => '16px (Default)',
                    '17px' => '17px',
                    '18px' => '18px (Medium)',
                    '20px' => '20px (Large)',
                    '22px' => '22px (Extra Large)',
                ],
            ],
            
            'font-weight-normal' => [
                'type' => 'select',
                'name' => 'font-weight-normal',
                'label' => 'Normal Font Weight',
                'default' => '400',
                'options' => [
                    '300' => '300 (Light)',
                    '400' => '400 (Normal)',
                    '500' => '500 (Medium)',
                ],
            ],
            
            'font-weight-medium' => [
                'type' => 'select',
                'name' => 'font-weight-medium',
                'label' => 'Medium Font Weight',
                'default' => '500',
                'options' => [
                    '400' => '400 (Normal)',
                    '500' => '500 (Medium)',
                    '600' => '600 (Semi-Bold)',
                ],
            ],
            
            'font-weight-bold' => [
                'type' => 'select',
                'name' => 'font-weight-bold',
                'label' => 'Bold Font Weight',
                'default' => '600',
                'options' => [
                    '600' => '600 (Semi-Bold)',
                    '700' => '700 (Bold)',
                    '800' => '800 (Extra-Bold)',
                ],
            ],

            /****************************************
             *   COLOR PALETTE SETTINGS
             ****************************************/
            'primary-color' => [
                'type' => 'colorpicker',
                'name' => 'primary-color',
                'label' => 'Primary Color',
                'default' => '#6366f1',
                'presets' => [
                    '#6366f1', // Indigo
                    '#3b82f6', // Blue
                    '#10b981', // Emerald
                    '#f59e0b', // Amber
                    '#ef4444', // Red
                    '#8b5cf6', // Violet
                    '#ec4899', // Pink
                    '#14b8a6', // Teal
                ],
            ],
            
            'secondary-color' => [
                'type' => 'colorpicker',
                'name' => 'secondary-color',
                'label' => 'Secondary Color',
                'default' => '#8b5cf6',
                'presets' => [
                    '#8b5cf6', // Violet
                    '#6366f1', // Indigo
                    '#3b82f6', // Blue
                    '#10b981', // Emerald
                    '#f59e0b', // Amber
                    '#ef4444', // Red
                    '#ec4899', // Pink
                    '#14b8a6', // Teal
                ],
            ],
            
            'accent-color' => [
                'type' => 'colorpicker',
                'name' => 'accent-color',
                'label' => 'Accent Color',
                'default' => '#f59e0b',
                'presets' => [
                    '#f59e0b', // Amber
                    '#ef4444', // Red
                    '#10b981', // Emerald
                    '#3b82f6', // Blue
                    '#8b5cf6', // Violet
                    '#ec4899', // Pink
                    '#14b8a6', // Teal
                    '#6366f1', // Indigo
                ],
            ],
            
            'text-color-primary' => [
                'type' => 'colorpicker',
                'name' => 'text-color-primary',
                'label' => 'Primary Text Color',
                'default' => '#1f2937',
                'presets' => [
                    '#1f2937', // Gray-800
                    '#111827', // Gray-900
                    '#374151', // Gray-700
                    '#000000', // Black
                    '#1e293b', // Slate-800
                ],
            ],
            
            'text-color-secondary' => [
                'type' => 'colorpicker',
                'name' => 'text-color-secondary',
                'label' => 'Secondary Text Color',
                'default' => '#6b7280',
                'presets' => [
                    '#6b7280', // Gray-500
                    '#9ca3af', // Gray-400
                    '#4b5563', // Gray-600
                    '#64748b', // Slate-500
                    '#94a3b8', // Slate-400
                ],
            ],
            
            'background-color' => [
                'type' => 'colorpicker',
                'name' => 'background-color',
                'label' => 'Background Color',
                'default' => '#ffffff',
                'presets' => [
                    '#ffffff', // White
                    '#f9fafb', // Gray-50
                    '#f3f4f6', // Gray-100
                    '#fef3c7', // Amber-50
                    '#dbeafe', // Blue-50
                    '#d1fae5', // Emerald-50
                ],
            ],
            
            'border-color' => [
                'type' => 'colorpicker',
                'name' => 'border-color',
                'label' => 'Border Color',
                'default' => '#e5e7eb',
                'presets' => [
                    '#e5e7eb', // Gray-200
                    '#d1d5db', // Gray-300
                    '#f3f4f6', // Gray-100
                    '#e2e8f0', // Slate-200
                    '#cbd5e1', // Slate-300
                ],
            ],

            /****************************************
             *   DARK MODE COLORS
             ****************************************/
            'dark-mode-enabled' => [
                'type' => 'checkbox',
                'name' => 'dark-mode-enabled',
                'label' => 'Enable Dark Mode',
                'default' => true,
            ],
            
            'dark-text-color-primary' => [
                'type' => 'colorpicker',
                'name' => 'dark-text-color-primary',
                'label' => 'Dark Mode Primary Text',
                'default' => '#f9fafb',
                'presets' => [
                    '#f9fafb', // Gray-50
                    '#ffffff', // White
                    '#f3f4f6', // Gray-100
                    '#e5e7eb', // Gray-200
                    '#f1f5f9', // Slate-100
                ],
            ],
            
            'dark-text-color-secondary' => [
                'type' => 'colorpicker',
                'name' => 'dark-text-color-secondary',
                'label' => 'Dark Mode Secondary Text',
                'default' => '#9ca3af',
                'presets' => [
                    '#9ca3af', // Gray-400
                    '#6b7280', // Gray-500
                    '#d1d5db', // Gray-300
                    '#94a3b8', // Slate-400
                    '#cbd5e1', // Slate-300
                ],
            ],
            
            'dark-background-color' => [
                'type' => 'colorpicker',
                'name' => 'dark-background-color',
                'label' => 'Dark Mode Background',
                'default' => '#111827',
                'presets' => [
                    '#111827', // Gray-900
                    '#1f2937', // Gray-800
                    '#000000', // Black
                    '#0f172a', // Slate-900
                    '#1e293b', // Slate-800
                ],
            ],
            
            'dark-border-color' => [
                'type' => 'colorpicker',
                'name' => 'dark-border-color',
                'label' => 'Dark Mode Border Color',
                'default' => '#374151',
                'presets' => [
                    '#374151', // Gray-700
                    '#4b5563', // Gray-600
                    '#1f2937', // Gray-800
                    '#334155', // Slate-700
                    '#475569', // Slate-600
                ],
            ],

            /****************************************
             *   LAYOUT & SPACING
             ****************************************/
            'container-max-width' => [
                'type' => 'select',
                'name' => 'container-max-width',
                'label' => 'Container Max Width',
                'default' => '1200px',
                'options' => [
                    '960px' => '960px (Small)',
                    '1140px' => '1140px (Medium)',
                    '1200px' => '1200px (Large)',
                    '1320px' => '1320px (Extra Large)',
                    '100%' => '100% (Full Width)',
                ],
            ],
            
            'border-radius' => [
                'type' => 'select',
                'name' => 'border-radius',
                'label' => 'Border Radius',
                'default' => '0.375rem',
                'options' => [
                    '0' => '0 (Square)',
                    '0.125rem' => '0.125rem (Small)',
                    '0.25rem' => '0.25rem',
                    '0.375rem' => '0.375rem (Default)',
                    '0.5rem' => '0.5rem (Medium)',
                    '0.75rem' => '0.75rem (Large)',
                    '1rem' => '1rem (Extra Large)',
                ],
            ],

            /****************************************
             *   ADVANCED OPTIONS
             ****************************************/
            'custom-css' => [
                'type' => 'textarea',
                'name' => 'custom-css',
                'label' => 'Custom CSS',
                'default' => '',
            ],
            
            'google-fonts-url' => [
                'type' => 'text',
                'name' => 'google-fonts-url',
                'label' => 'Google Fonts URL',
                'default' => '',
                'placeholder' => 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap',
            ],
        ],
    ],

    /****************************************
     *   CONTACT SETTINGS
     ****************************************/
    'contact_settings' => [
        'fields' => [
            'address' => [
                'type' => 'text',
                'name' => 'address',
                'label' => 'Address',
                'default' => '',
            ],
            'phone' => [
                'type' => 'text',
                'name' => 'phone',
                'label' => 'Phone',
                'default' => '',
            ],
            'email' => [
                'type' => 'text',
                'name' => 'email',
                'label' => 'Email',
                'default' => '',
            ],
        ],
    ],

];
