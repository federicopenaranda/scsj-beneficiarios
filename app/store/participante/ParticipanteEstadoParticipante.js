Ext.define('sisscsj.store.participante.ParticipanteEstadoParticipante', {
    extend: 'sisscsj.store.Base',
    alias: 'store.participante.participanteestadoparticipante',
    requires: [
        'sisscsj.model.participante.ParticipanteEstadoParticipante'
    ],
    restPath: 'BeneficiarioEstadoBeneficiario',
    storeId: 'ParticipanteEstadoParticipante',
    model: 'sisscsj.model.participante.ParticipanteEstadoParticipante'
});