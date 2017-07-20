Ext.define('sisscsj.view.participante.edit.tab.ActividadFavorita', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.participante.edit.tab.actividadfavorita',
    layout: 'form',
    requires: [
        'Ext.form.Panel',
        'Ext.tip.QuickTipManager',
        'sisscsj.store.opciones.ActividadFavorita',
        'Ext.ux.form.ItemSelector'
        ],
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
                
        var storeActividadFavorita = Ext.data.StoreManager.lookup('opciones.ActividadFavorita');
        storeActividadFavorita.load();

        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'itemselector',
                    itemId: 'beneficiario_actividad_favorita',
                    name: 'beneficiario_actividad_favorita',
                    id: 'beneficiario_actividad_favorita',
                    anchor: '100%',
                    store: storeActividadFavorita,
                    displayField: 'nombre_actividad_favorita',
                    valueField: 'id_actividad_favorita',
                    allowBlank: true,
                    msgTarget: 'side',
                    fromTitle: 'Actividades Disponibles',
                    toTitle: 'Actividades Seleccionados',
                    buttons: [ 'add', 'remove' ],
                    delimiter: null,
                    overflowY: 'scroll',
                    height: 350
                }
            ]
        });
        me.callParent(arguments);
    }
});