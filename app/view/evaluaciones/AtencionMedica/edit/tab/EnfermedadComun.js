Ext.define('sisscsj.view.evaluaciones.AtencionMedica.edit.tab.EnfermedadComun', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.evaluaciones.atencionmedica.edit.tab.enfermedadcomun',
    layout: 'form',
    requires: [
        'Ext.form.Panel',
        'Ext.tip.QuickTipManager',
        'sisscsj.store.opciones.EnfermedadComun',
        'Ext.ux.form.ItemSelector'
        ],
    bodyPadding: 0,
    margin: 5,
    initComponent: function() {

        var storeEnfermedadComun = Ext.data.StoreManager.lookup('opciones.EnfermedadComun');
        storeEnfermedadComun.load();

        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'itemselector',
                    itemId: 'atencion_medica_enfermedad_comun',
                    name: 'atencion_medica_enfermedad_comun',
                    anchor: '100%',
                    store: storeEnfermedadComun,
                    displayField: 'nombre_enfermedad_comun',
                    valueField: 'id_enfermedad_comun',
                    allowBlank: true,
                    msgTarget: 'side',
                    fromTitle: 'Enfermedades Disponibles',
                    toTitle: 'Enfermedades Seleccionadas',
                    buttons: [ 'add', 'remove' ],
                    delimiter: null,
                    overflowY: 'scroll',
                    height: 250
                }
            ]
        });
        me.callParent(arguments);
    }
});