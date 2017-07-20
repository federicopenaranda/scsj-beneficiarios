Ext.define('sisscsj.store.participante.ParticipanteGestion', {
    extend: 'sisscsj.store.Base',
    alias: 'store.participante.participantegestion',
    requires: [
        'sisscsj.model.participante.ParticipanteGestion'
    ],
    restPath: 'GestionBeneficiario',
    storeId: 'ParticipanteGestion',
    model: 'sisscsj.model.participante.ParticipanteGestion'
});