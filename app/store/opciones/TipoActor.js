Ext.define('sisscsj.store.opciones.TipoActor', {
    extend: 'sisscsj.store.Base',
    alias: 'store.opciones.tipoactor',
    requires: [
        'sisscsj.model.opciones.TipoActor'
    ],
    restPath: 'TipoActorBeneficiario',
    storeId: 'TipoActor',
    model: 'sisscsj.model.opciones.TipoActor'
});

