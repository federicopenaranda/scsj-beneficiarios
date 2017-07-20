Ext.define('sisscsj.model.resultadoevaluacion.ResultadoEvaluacion', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_resultado_evaluacion',
    fields: [
        // id field
        {
            name: 'id_resultado_evaluacion',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_resultado',
            type: 'int',
            useNull: true
        },
        {
            name: 'tipo_resultado_evaluacion',
            type: 'string',
            useNull: true
        },
        {
            name: 'informacion_cualitativa_resultado_evaluacion',
            type: 'string',
            useNull: true
        },
        {
            name: 'accion_seguimiento_resultado_evaluacion',
            type: 'string',
            useNull: true
        },
        {
            name: 'evaluacion_resultado_evaluacion',
            type: 'string',
            useNull: true
        }
    ]
});