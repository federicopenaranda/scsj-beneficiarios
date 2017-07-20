Ext.define('sisscsj.store.resultadoevaluacion.ResultadoEvaluacion', {
    extend: 'sisscsj.store.Base',
    alias: 'store.resultadoevaluacion.resultadoevaluacion',
    requires: [
        'sisscsj.model.resultadoevaluacion.ResultadoEvaluacion'
    ],
    restPath: 'ResultadoEvaluacion',
    storeId: 'ResultadoEvaluacion',
    model: 'sisscsj.model.resultadoevaluacion.ResultadoEvaluacion'
});