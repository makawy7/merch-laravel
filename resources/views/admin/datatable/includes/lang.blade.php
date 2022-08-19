//translations
language: {
   search: "{{__('admindash.datatable.search')}}: ",
   buttons: {
       copyTitle: "{{trans('admindash.datatable.copy.copied')}}",
       copySuccess: {
           _: `{{__('admindash.datatable.copy.copied_m',['num'=>'%d'])}}`,
           1: 'Copié 1 rang'
       },

   },
   paginate: {
       previous:     "{{__('admindash.datatable.pre')}}",
       next:         "{{__('admindash.datatable.next')}}",
             },
   processing:   "{{__('admindash.datatable.processing')}}",
   lengthMenu:   `{{__('admindash.datatable.length_menu',['menu'=>'_MENU_'])}}`,
   info:           `{{__('admindash.datatable.showing',['start'=>'_START_','end'=>'_END_','record'=>'_TOTAL_'])}}`,
   infoEmpty:      `{{__('admindash.datatable.showing_empty')}}`,
   infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
   infoPostFix:    "",
   loadingRecords: "Chargement en cours...",
   zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
   emptyTable:     "{{__('admindash.datatable.table_empty')}}",

   aria: {
       sortAscending:  ": activer pour trier la colonne par ordre croissant",
       sortDescending: ": activer pour trier la colonne par ordre décroissant"
       },
},
