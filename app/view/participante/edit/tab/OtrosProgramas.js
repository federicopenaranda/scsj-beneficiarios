Ext.define('sisscsj.view.participante.edit.tab.OtrosProgramas', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.participante.edit.tab.otrosprogramas',
    layout: 'form',
    requires: [
        'Ext.form.Panel',
        'Ext.tip.QuickTipManager',
        'sisscsj.store.opciones.OtrosProgramas',
        'Ext.ux.form.ItemSelector'
        ],
    bodyPadding: 0,
    margin: -5,
    initComponent: function() {
                
        var storeOtrosProgramas = Ext.data.StoreManager.lookup('opciones.OtrosProgramas');
        storeOtrosProgramas.load();

        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'itemselector',
                    itemId: 'beneficiario_otros_programas',
                    name: 'beneficiario_otros_programas',
                    anchor: '100%',
                    store: storeOtrosProgramas,
                    displayField: 'nombre_otros_programas',
                    valueField: 'id_otros_programas',
                    allowBlank: true,
                    msgTarget: 'side',
                    fromTitle: 'Programas Disponibles',
                    toTitle: 'Programas Seleccionados',
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