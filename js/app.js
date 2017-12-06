$( document ).ready(function() {
    $('#paso_1').on('click', function()
    {
        var numero_restricciones = $('#numero_restricciones').val();
        var numero_variables = $('#numero_variables').val();
        
        //Reset html
        $('#valores').html('');

        //Restricciones
        $('#valores').append('<h3>Restricciones</h3>');
        let restricciones_html = '';
        for(r= 0; r<numero_restricciones;r++)
        {
            restricciones_html += '<div class="row" id="restriccion_'+r+'">';
            for (b = 0; b<numero_variables ; b++)
            {
                if(b==(numero_variables-1)){
                    restricciones_html += ' <div class="form-group"> \
                    <div class="input-group">\
                    <input type="text" class="form-control" name="restricciones['+r+'][valor][]"> x'+ (b+1) + '\
                    </div> \
                    </div>';

                    restricciones_html += ' <div class="form-group"> \
                    <select name="restricciones['+r+'][operador]" class="form-control">  \
                    <option value="<="><=</option> \
                    <option value=">=">>=</option> \
                    <option value="=">=</option> \
                    </select> \
                    </div>';

                    restricciones_html += ' <div class="form-group"> \
                    <input type="text" class="form-control" name="restricciones['+r+'][resultado]"> \
                    </div>';
                }else{
                    restricciones_html += ' <div class="form-group"> \
                    <div class="input-group">\
                    <input type="text" class="form-control" name="restricciones['+r+'][valor][]"> x'+ (b+1) + ' + \
                    </div> \
                    </div>';
                }
            }   
            restricciones_html += '</div>';
        }     

        
        $('#valores').append(restricciones_html);

        //Funcion Objetivo
        $('#valores').append('<h3>Función objetivo</h3>');
        let funcion_objetivo_html = '<div class="row">'
        for (b = 0; b<numero_variables ; b++)
        {
            if(b==(numero_variables-1)){
                funcion_objetivo_html += ' <div class="form-group"> \
                <div class="input-group">\
                <input type="text" class="form-control" name="funcion_objetivo[]"> x'+ (b+1) + '\
                </div> \
                </div>';
            }else{
                funcion_objetivo_html += ' <div class="form-group"> \
                <div class="input-group">\
                <input type="text" class="form-control" name="funcion_objetivo[]"> x'+ (b+1) + ' + \
                </div> \
                </div>';
            }
        }
        funcion_objetivo_html += '</div>';
        $('#valores').append(funcion_objetivo_html);

        
        
        $('#valores').append('<button type="submit" class="btn btn-primary" id="enviar">Resolver</button>');
    });
});