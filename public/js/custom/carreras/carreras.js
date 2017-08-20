$('#carreras').dynatable({
    dataset: {
      ajax:true,
      ajaxUrl: '/carreras/listado/dynatable',
      ajaxOnLoad: true,
      records:[],
      search:true,
      sorting:true,
      perPageOptions : [5, 10, 25, 50, 100],
      records: 'registros',

      inputs: {
        recordCountPageBoundTemplate: '{pageLowerBound} al {pageUpperBound} de'
      }

    },

    inputs: {
      processingText: 'Loading <img src="/images/gifs/gif-load.gif" />',
      searchText: 'Buscar: ',
      recordCountText:'Mostrando ',
      paginationPrev: 'Anterior',
      paginationNext: 'Siguiente',
      paginationGap: [1,2,2,1],
      searchTarget: null,
      searchPlacement: 'before',
      searchText: 'Search: ',
      perPageTarget: null,
      perPagePlacement: 'before',
      perPageText: 'Mostrar: ',
      pageText: 'Páginas: ',
      recordCountPageBoundTemplate: '{pageLowerBound} al {pageUpperBound} de',
      recordCountPageUnboundedTemplate: '{recordsShown} of'
    },
    features: {
      search:true,
      paginate:true,
      pushState:true,
      recordCount:true,
      perPageSelect:true
    },
    params: {
  //  records: '_root'
  }
});

$('#vueltas').change(function($val) {
      var vueltas = $(this).val();
      traeEstructura(
        {'vueltas' : vueltas}, true
      );
});

$('#caja_vueltas').on('click', '.btn-delete', function() {
    var $this = $(this);
    $this.closest('.gr-vueltas').remove();
    recalcularVueltas();
});

$('#nueva_caja').on('click', '.btn-add', function() {
    var numero = $('.gr-vueltas').length + 1;
    var edit = $(this).data('edit')? $(this).data('edit') : 0;
    traeEstructura({
      'numero' : numero
    });
});

function traeEstructura(data , reset) {
  var reset = reset | '';
  $.get('/estructuras/vueltas', data , function(response) {
      if (response.status == 'OK') {
          var boxVueltas = response.vueltas;
          var $box = $('#caja_vueltas');
          if (reset) $box.html('');
          boxVueltas.forEach(function(boxVuelta) {
              $box.append($(boxVuelta));
          })
      }
  });
}

function recalcularVueltas() {
    $('body .gr-vueltas').each(function(loop, ele) {
        $(ele).find('label').eq(0).html('Vuelta ' + (loop+1) );
        $(ele).find('label').eq(1).html('Distancia ' + (loop+1));
        $(ele).find('.orden').eq(0).val((loop+1));
    });
}

if ($('#caja_vueltas[getVueltas]').length) {
    var carrera = parseInt($('#caja_vueltas').data('carrera'));
    traeEstructura({
      'carrera' : carrera
    }, true);
}
