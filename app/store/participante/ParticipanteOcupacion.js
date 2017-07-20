Ext.define('sisscsj.store.participante.ParticipanteOcupacion', {
    extend: 'sisscsj.store.Base',
    alias: 'store.participante.participanteocupacion',
    requires: [
        'sisscsj.model.participante.ParticipanteOcupacion'
    ],
    restPath: 'BeneficiarioOcupacion',
    storeId: 'ParticipanteOcupacion',
    model: 'sisscsj.model.participante.ParticipanteOcupacion'
});