/**
 * Store para manejar las beneficiario
 */
Ext.define('sisscsj.store.opciones.EvalEduNelsonOrtiz', {
    extend: 'sisscsj.store.Base',
    alias: 'store.opciones.evaledunelsonortiz',
    requires: [
        'sisscsj.model.opciones.EvalEduNelsonOrtiz'
    ],
    restPath: 'EvalEduNelsonOrtiz',
    storeId: 'EvalEduNelsonOrtiz',
    model: 'sisscsj.model.opciones.EvalEduNelsonOrtiz'
});