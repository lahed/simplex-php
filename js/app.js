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
            restricciones_html += '<div class="form-inline" id="restriccion_'+r+'">';
            for (b = 0; b<numero_variables ; b++)
            {
                if(b==(numero_variables-1)){
                    restricciones_html += ' \
                    <label for="" class="sr-only"></label> \
                    <div class="input-group col-xs-8-variables"> \
                        <div class="input-group">\
                        <input type="text" class="form-control form-control-fixed" name="restricciones['+ r +'][valor][]" required>\
                        <div class="input-group-addon"><b> X' + (b+1) +'</b></div> \
                        </div> \
                    </div>';

                    restricciones_html += '\
                        <select name="restricciones['+r+'][operador]" class="form-control col-xs-8-variables" >  \
                            <option value="<="><=</option> \
                            <option value=">=">>=</option> \
                            <option value="=">=</option> \
                        </select>';

                    restricciones_html += ' \
                    <div class="input-group col-xs-8-variables"> \
                        <input type="text" class="form-control form-control-fixed" name="restricciones['+r+'][resultado]" required> \
                    </div>';
                }else{
                    restricciones_html += ' \
                    <div class="input-group col-xs-8-variables"> \
                        <input type="text" class="form-control form-control-fixed" name="restricciones['+r+'][valor][]" required> \
                        <div class="input-group-addon"><b> X' + (b+1) +'</b></div> \
                    </div>';
                }
            }
            restricciones_html += '</div>';
        }


        $('#valores').append(restricciones_html);

        //Funcion Objetivo
        $('#valores').append('<h3>Función objetivo</h3>');
        let funcion_objetivo_html = '<div class="form-inline">'
        for (b = 0; b<numero_variables ; b++)
        {
            if(b==(numero_variables-1)){
                funcion_objetivo_html += ' \
                <div class="input-group col-xs-8-variables">\
                    <input type="text" class="form-control form-control-fixed" name="funcion_objetivo[]"> \
                    <div class="input-group-addon"><b> X' + (b+1) +'</b></div> \
                </div>';
            }else{
                funcion_objetivo_html += '\
                <div class="input-group col-xs-8-variables">\
                    <input type="text" class="form-control" name="funcion_objetivo[]">\
                    <div class="input-group-addon"><b> X' + (b+1) +'</b></div> \
                </div>';
            }
        }
        funcion_objetivo_html += '</div>';
        $('#valores').append(funcion_objetivo_html);



        $('#valores').append('<button type="submit" class="btn btn-primary" id="enviar">Resolver</button>');
    });
});
