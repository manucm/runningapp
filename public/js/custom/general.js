/*****************
* Plugin Select2 *
******************/
//Inicializar
$('.select').select2();
//Select 2 con la posibilidad de agregar item
$('.select-agregate').select2({tags:true,createTag: function (params) {
    return {
      id: params.term,
      text: params.term,
      newOption: true
    }
}});

/***************************************
* Plugin datepicker bootstrap material *
****************************************/
$('.datetimepicker').bootstrapMaterialDatePicker({
  format :'DD-MM-YYYY HH:mm',
  clearButton: true
});

/*******************
* Plugin Dynatable *
********************/
$('.dynatable').dynatable({
  table: {
    defaultColumnIdStyle: 'camelCase'
  }
});
