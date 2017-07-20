Ext.define('sisscsj.view.participante.search.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.participante.search.form',
    requires: [
        'Ext.form.FieldContainer',
        'Ext.form.FieldSet',
        'Ext.form.field.Date',
        'Ext.form.field.Text',
        'Ext.form.field.ComboBox',
        'Ext.slider.Multi',
        'sisscsj.ux.form.field.RemoteComboBox',
        'sisscsj.ux.form.field.plugin.ClearTrigger'
    ],
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            fieldDefaults: {
                labelAlign: 'top',
                flex: 1,
                margins: 5
            },
            items: [
                {
                    xtype: 'fieldset',
                    title: 'Detalles del Participante',
                    collapsible: true,
                    items: [
                        {
                            xtype: 'fieldcontainer',
                            layout: 'hbox',
                            items: [
                                {
                                    xtype: 'textfield',
                                    name: 'codigo_beneficiario',
                                    fieldLabel: 'Código:'
                                },
                                {
                                    xtype: 'textfield',
                                    name: 'primer_nombre_beneficiario',
                                    fieldLabel: 'Primer Nombre:'
                                }
                            ]
                        },
                        {
                            xtype: 'fieldcontainer',
                            layout: 'hbox',
                            items: [
                                {
                                    xtype: 'textfield',
                                    name: 'apellido_paterno_beneficiario',
                                    fieldLabel: 'Apellido Paterno:'
                                },
                                {
                                    xtype: 'textfield',
                                    name: 'apellido_materno_beneficiario',
                                    fieldLabel: 'Apellido Materno:'
                                }
                            ]
                        }
                    ]
                }
            ]
        });
        me.callParent( arguments );
    }
});