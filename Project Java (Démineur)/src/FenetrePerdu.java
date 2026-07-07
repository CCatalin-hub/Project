import javax.swing.*;
import java.awt.*;

public class FenetrePerdu extends JFrame {
    private FenetreJeu jeu;

    public FenetrePerdu(FenetreJeu jeuEnCours) {
        this.jeu = jeuEnCours;

        setTitle("Perdu");
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setSize(400, 300); 
        setLocationRelativeTo(null);

        JPanel panel = new JPanel(new BorderLayout());
        panel.setBackground(Color.BLACK);

        JLabel labelMessage = new JLabel("VOUS AVEZ PERDU !", SwingConstants.CENTER);
        labelMessage.setFont(new Font("Arial", Font.BOLD, 24));
        labelMessage.setForeground(Color.RED);
        panel.add(labelMessage, BorderLayout.CENTER);

        JPanel controlPanel = new JPanel();
        controlPanel.setBackground(Color.BLACK);

        JButton boutonMenu = new JButton("Menu");
        JButton boutonQuitter = new JButton("Quitter");

        boutonQuitter.addActionListener(new EcouteurPerdu(this,2, jeu));
        boutonMenu.addActionListener(new EcouteurPerdu(this,1, jeu));

        controlPanel.add(boutonMenu);
        controlPanel.add(boutonQuitter);

        panel.add(controlPanel, BorderLayout.SOUTH);

        setContentPane(panel);
        setVisible(true); 
    }
}