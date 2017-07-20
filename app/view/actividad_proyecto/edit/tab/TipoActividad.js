Ext.define('sisscsj.view.actividad_proyecto.edit.tab.TipoActividad', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.actividad_proyecto.edit.tab.tipoactividad',
    layout: 'form',
    requires: [
        'Ext.form.Panel',
        'Ext.tip.QuickTipManager',
        'sisscsj.store.opciones.TipoActividad',
        'Ext.ux.form.ItemSelector'
        ],
    bodyPadding: 0,
    margin: 5,
    initComponent: function() {
                
        var storeTipoActividad = Ext.data.StoreManager.lookup('opciones.TipoActividad');
        storeTipoActividad.load();

        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    //html: '<div id="featuresdiv"></div>'
                    xtype: 'itemselector',
                    itemId: 'actividad_proyecto_tipo_actividad',
                    name: 'actividad_proyecto_tipo_actividad',
                    anchor: '100%',
                    store: storeTipoActividad,
                    displayField: 'nombre_tipo_actividad',
                    valueField: 'id_tipo_actividad',
                    allowBlank: true,
                    msgTarget: 'side',
                    fromTitle: 'Tipos de Actividad Disponibles',
                    toTitle: 'Tipos de Actividad Seleccionados',
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