Ext.define('sisscsj.store.participante.ParticipanteTrabajo', {
    extend: 'sisscsj.store.Base',
    alias: 'store.participante.participantetrabajo',
    requires: [
        'sisscsj.model.participante.ParticipanteTrabajo'
    ],
    restPath: 'BeneficiarioTrabajo',
    storeId: 'ParticipanteTrabajo',
    model: 'sisscsj.model.participante.ParticipanteTrabajo'
});