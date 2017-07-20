Ext.define('sisscsj.view.actividad_proyecto.actividad_tipo_participante.edit.tab.Asistencia', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.actividad_proyecto.actividad_tipo_participante.edit.tab.asistencia',
    layout: 'form',
    bodyPadding: 0,
    margin: 5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            items: [
                {
                    xtype: 'fieldset',
                    title: '<strong>Asistencia por Tipo de Participante</strong>',
                    defaults: {
                        layout: 'hbox',
                        margins: '0 10 0 10'
                    },
                    items: [
                        {
                            xtype: 'fieldcontainer',
                            items: [
                                {
                                    xtype: 'ux.form.field.remotecombobox',
                                    name: 'fk_id_edades_beneficiario',
                                    fieldLabel: 'Tipo de Participante (Edad):',
                                    displayField: 'nombre_edades_beneficiario',
                                    valueField: 'id_edades_beneficiario',
                                    store: {
                                        type: 'opciones.edadesbeneficiario'
                                    },
                                    editable: false,
                                    forceSelection: true
                                },
                                {
                                    xtype: 'numberfield',
                                    name: 'cantidad_actividad_tipo_participante',
                                    fieldLabel: 'Cantidad:'
                                },
                                {
                                    xtype: 'combo',
                                    name: 'sexo_actividad_tipo_participante',
                                    fieldLabel: 'Género:',
                                    displayField: 'nombre',
                                    valueField: 'valor',
                                    store: new Ext.data.SimpleStore({
                                        fields: ['nombre', 'valor'],
                                        data : [['Mujer', 'f'],['Varón', 'm']]
                                    }),
                                    editable: false,
                                    forceSelection: true,
                                    allowBlank: false
                                }
                            ]
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});