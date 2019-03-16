<?php

return [
  'title'=> 'GE OEE System',  
  'template' => ciscmodule\getemplate\Template::class,  
//  'template' => ciscmodule\modoee\Template::class,  
  'modprefix' => [
      'modoee' => 'modoee',
      'oeeprzedmont' => 'oeemontaz',
  ],  
    /**
     * Moduły zainstalowane w systemie i ich id
     */
  'modulename' => [
      '6' => 'Montaż',
      '12' => 'Oprzewodowanie sterownicze',
  ],  
  'moduleurl' => [
//        '11' => route("extableblend"),
        '6' => '/oeemontaz?',
        '12' => '/extable?'
  ],  
  'moduleadminurl' => [
//        '11' => route("extableblend"),
        '6' => '/admin/oeemontaz?',
        '12' => '/admin/oeeprzedmontdanes?'
  ],  

  'module' => [
        \ciscmodule\oeeprzedmont\oeeprzedmont::class
  ]  
];
