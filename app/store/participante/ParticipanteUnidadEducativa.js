Ext.define('sisscsj.store.participante.ParticipanteUnidadEducativa', {
    extend: 'sisscsj.store.Base',
    alias: 'store.participante.participanteunidadeducativa',
    requires: [
        'sisscsj.model.participante.ParticipanteUnidadEducativa'
    ],
    restPath: 'BeneficiarioUnidadEducativa',
    storeId: 'ParticipanteUnidadEducativa',
    model: 'sisscsj.model.participante.ParticipanteUnidadEducativa'
});