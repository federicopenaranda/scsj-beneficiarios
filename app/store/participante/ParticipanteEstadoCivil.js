Ext.define('sisscsj.store.participante.ParticipanteEstadoCivil', {
    extend: 'sisscsj.store.Base',
    alias: 'store.participante.participanteestadocivil',
    requires: [
        'sisscsj.model.participante.ParticipanteEstadoCivil'
    ],
    restPath: 'BeneficiarioEstadoCivil',
    storeId: 'ParticipanteEstadoCivil',
    model: 'sisscsj.model.participante.ParticipanteEstadoCivil'
});