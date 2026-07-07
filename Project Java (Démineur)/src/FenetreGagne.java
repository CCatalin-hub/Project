import javax.swing.*;
import java.awt.*;

public class FenetreGagne extends JFrame {
    private FenetreJeu jeu;

    public FenetreGagne(FenetreJeu jeuEnCours) {
        this.jeu = jeuEnCours;

        setTitle("Gagné");
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setSize(400, 300); 
        setLocationRelativeTo(jeuEnCours);

        JPanel panel = new JPanel(new BorderLayout());
        panel.setBackground(Color.BLACK);

        JLabel labelMessage = new JLabel("VOUS AVEZ GAGNÉ !", SwingConstants.CENTER);
        labelMessage.setFont(new Font("Arial", Font.BOLD, 24));
        labelMessage.setForeground(Color.GREEN);
        panel.add(labelMessage, BorderLayout.CENTER);

        JPanel controlPanel = new JPanel();
        controlPanel.setBackground(Color.BLACK);

        JButton boutonMenu = new JButton("Menu");
        JButton boutonQuitter = new JButton("Quitter");

        boutonQuitter.addActionListener(new EcouteurGagne(this, 2, jeu));
        boutonMenu.addActionListener(new EcouteurGagne(this, 1, jeu));

        controlPanel.add(boutonMenu);
        controlPanel.add(boutonQuitter);

        panel.add(controlPanel, BorderLayout.SOUTH);

        setContentPane(panel);
        setVisible(true); 
    }
}