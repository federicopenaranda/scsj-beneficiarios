Ext.define('sisscsj.store.participante.ParticipanteEntidad', {
    extend: 'sisscsj.store.Base',
    alias: 'store.participante.participanteentidad',
    requires: [
        'sisscsj.model.participante.ParticipanteEntidad'
    ],
    restPath: 'BeneficiarioEntidad',
    storeId: 'ParticipanteEntidad',
    model: 'sisscsj.model.participante.ParticipanteEntidad'
});