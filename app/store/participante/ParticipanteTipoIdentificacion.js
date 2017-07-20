Ext.define('sisscsj.store.participante.ParticipanteTipoIdentificacion', {
    extend: 'sisscsj.store.Base',
    alias: 'store.participante.participantetipoidentificacion',
    requires: [
        'sisscsj.model.participante.ParticipanteTipoIdentificacion'
    ],
    restPath: 'BeneficiarioTipoIdentificacion',
    storeId: 'ParticipanteTipoIdentificacion',
    model: 'sisscsj.model.participante.ParticipanteTipoIdentificacion'
});