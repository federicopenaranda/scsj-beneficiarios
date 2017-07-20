Ext.define('sisscsj.store.participante.ParticipanteTelefono', {
    extend: 'sisscsj.store.Base',
    alias: 'store.participante.participantetelefono',
    requires: [
        'sisscsj.model.participante.ParticipanteTelefono'
    ],
    restPath: 'BeneficiarioTelefono',
    storeId: 'ParticipanteTelefono',
    model: 'sisscsj.model.participante.ParticipanteTelefono'
});