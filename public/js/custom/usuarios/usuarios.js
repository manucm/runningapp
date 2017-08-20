// Function that renders the list items from our records
function ulWriter(rowIndex, record, columns, cellWriter) { console.log(record);
  var cssClass = "span4", li;
  if (rowIndex % 3 === 0) { cssClass += ' first'; }
  li = '<li class="span4" data-color="gray">' +
        '  <div class="thumbnail">' +
        '    <div class="thumbnail-image">' +
        '      <img src="/images/dinosaurs/Stegosaurus_BW.jpg" />' +
        '    </div>' +
        '    <div class="caption">' +
        '      <h3>' + record.nombre + '</h3>' +
        '      <p>State: Colorado</p>' +
        '      <p>Year: 1982</p>' +
        '      <p><a href="http://en.wikipedia.org/wiki/Stegosaurus" class="btn btn-primary">View</a> <a href="#" class="btn">View</a></p>' +
        '    </div>' +
        '  </div>' +
        '</li>';
  return li;
}

$('#ul-example').dynatable({
  table: {
    headRowSelector: 'ul',
    bodyRowSelector: 'li'
  },
  dataset: {
    ajax:true,
    ajaxUrl: '/administracion/usuarios/dynalist',
    ajaxOnLoad: true,
    records:[],
    search:true,
    sorting:true,
    perPageDefault: 2,
    perPageOptions : [2,4, 5, 10, 25, 50, 100]
  },
  writers: {
    _rowWriter: ulWriter
  },
  inputs: {
    processingText: 'Loading <img src="/images/gifs/gif-load.gif" />'
  }
});
