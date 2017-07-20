/**
 * Formulario para crear unidades educativas
 */

var nelsonortiz = Ext.create('Ext.data.Store', {
        fields: ['nombre', 'valor'],
        data : [
            {"nombre":"Alerta", "valor":"alerta"},
            {"nombre":"Medio Bajo", "valor":"medio_bajo"},
            {"nombre":"Medio Alto", "valor":"medio_alto"},
            {"nombre":"Alto", "valor":"alto"}
        ]
    });




Ext.define('sisscsj.view.opciones.EvalEduNelsonOrtiz.edit.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.opciones.evaledunelsonortiz.edit.form',
    requires: [
        'Ext.form.FieldContainer',
        'Ext.form.field.Text',
        'Ext.form.field.ComboBox',
        'sisscsj.ux.form.field.RemoteComboBox'
    ],
    bodyPadding: 5,
    initComponent: function() {
        var me = this;
        Ext.applyIf(me, {
            fieldDefaults: {
                allowBlank: false,
                labelAlign: 'top',
                flex: 1,
                margins: 5
            },
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
                            name: 'fk_id_tipo_consulta',
                            fieldLabel: 'Tipo de Consulta:',
                            displayField: 'nombre_tipo_consulta',
                            valueField: 'id_tipo_consulta',
                            store: {
                                type: 'opciones.tipoconsulta'
                            },
                            plugins: [
                                { ptype: 'cleartrigger' }
                            ],
                            editable: false,
                            forceSelection: true
                        },
                        {
                            xtype: 'datefield',
                            name: 'fecha_nelson_ortiz',
                            fieldLabel: 'Fecha:',
                            format: 'Y-m-d',
                            submitFormat: 'Y-m-d'
                        }
                    ]
                },
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            name: 'motricidad_gruesa_nelson_ortiz',
                            xtype: 'combo',
                            fieldLabel: 'Motricidad Gruesa:',
                            store: nelsonortiz,
                            triggerAction: 'all',
                            valueField: 'valor',
                            displayField: 'nombre',
                            queryMode: 'local',
                            forceSelection: true,
                            selectOnFocus: true
                        },
                        {
                            name: 'audicion_lenguaje_nelson_ortiz',
                            xtype: 'combo',
                            fieldLabel: 'Audición Lenguaje:',
                            store: nelsonortiz,
                            triggerAction: 'all',
                            valueField: 'valor',
                            displayField: 'nombre',
                            queryMode: 'local',
                            forceSelection: true,
                            selectOnFocus: true
                        }
                    ]
                },
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            name: 'motricidad_fina_nelson_ortiz',
                            xtype: 'combo',
                            fieldLabel: 'Motricidad Fina:',
                            store: nelsonortiz,
                            triggerAction: 'all',
                            valueField: 'valor',
                            displayField: 'nombre',
                            queryMode: 'local',
                            forceSelection: true,
                            selectOnFocus: true
                        },
                        {
                            name: 'personal_social_nelson_ortiz',
                            xtype: 'combo',
                            fieldLabel: 'Personal Social:',
                            store: nelsonortiz,
                            triggerAction: 'all',
                            valueField: 'valor',
                            displayField: 'nombre',
                            queryMode: 'local',
                            forceSelection: true,
                            selectOnFocus: true
                        }
                    ]
                },
                {
                    xtype: 'fieldcontainer',
                    items: [
                        {
                            xtype: 'textareafield',
                            name: 'observaciones_nelson_ortiz',
                            fieldLabel: '<strong>Observaciones</strong>',
                            height: 150
                        },
                        {
                            xtype: 'numberfield',
                            name: 'fk_id_beneficiario',
                            fieldLabel: 'ID Beneficiario:',
                            value: '1'
                        }
                    ]
                }
            ]
        });
        me.callParent(arguments);
    }
});